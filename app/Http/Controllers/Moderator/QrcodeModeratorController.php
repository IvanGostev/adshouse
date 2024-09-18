<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Qrcode;
use App\Models\Room;

use Illuminate\Http\Request;
use Illuminate\View\View;

class QrcodeModeratorController extends Controller
{

    public function index(): View
    {
        $qrcodes = Qrcode::paginate(10);
        foreach ($qrcodes as &$qrcode) {
            $qrcode['qrcode'] = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->style('round')->generate(route('qrcode', $qrcode->id));
        }
        $ids = Qrcode::pluck('room_id')->toArray();
        $rooms = Room::where('status', 'active')->whereNotIn('id', $ids)->get();
        return view('moderator.qrcode.index', compact('qrcodes', 'rooms'));
    }

    public function store(Request $request)
    {
        Qrcode::create();
        return back();
    }
    public function search(Request $request, Qrcode $qrcode) {
        $rooms = Room::query();
        $rooms->join('houses', 'houses.id', '=', 'rooms.house_id');
        $rooms->join('users', 'users.id', '=', 'houses.user_id');
        $data = $request->all();

        if ($data['city_id'] != 'all') {
            $rooms->where('houses.city_id',  $data['city_id']);
        }

        if ($data['district_id'] != 'all') {
            $rooms->where('houses.district_id',  $data['district_id']);
        }

        if (isset($data['street'])) {
            $rooms->where('houses.street','LIKE',"%{$data['street']}%");
        }
        if (isset($data['email'])) {
            $rooms->where('users.email','LIKE',"%{$data['email']}%");
        }


        $ids = Qrcode::pluck('room_id')->toArray();
        $ids = array_filter($ids, function ($element) {
            return $element !== null;
        });
        $rooms = $rooms->where('rooms.status', 'active')
            ->whereNotIn('rooms.id', $ids)
            ->select('rooms.*')
            ->paginate($data['paginateNumber'] ?? 12);
        $cities = City::all();
        $districts = District::all();
        $roomActive = Room::where('id', $qrcode->room_id)->first();
        return view('moderator.qrcode.edit', compact('qrcode', 'rooms', 'cities', 'districts', 'roomActive'));
    }

    public function edit(Qrcode $qrcode)
    {
        $ids = Qrcode::pluck('room_id')->toArray();
        $ids = array_filter($ids, function ($element) {
            return $element !== null;
        });
        $rooms = Room::where('condition', 'free')->where('status', 'approved')->whereNotIn('id', $ids)->paginate(10);
        $cities = City::all();
        $districts = District::all();
        $roomActive = Room::where('id', $qrcode->room_id)->first();
        return view('moderator.qrcode.edit', compact('qrcode', 'rooms', 'cities', 'districts', 'roomActive'));
    }

    public function update(Qrcode $qrcode, Request $request)
    {
        $qrcode->update(['room_id' => $request->room_id]);
        return redirect()->route('moderator.qrcode.index');
    }
    public function free(Qrcode $qrcode, Request $request)
    {
        $qrcode->update(['room_id' => null]);
        return redirect()->route('moderator.qrcode.index');
    }
    public function destroy(Qrcode $qrcode)
    {
        $qrcode->delete();
        return back();
    }
}
