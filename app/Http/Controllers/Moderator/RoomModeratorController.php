<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\House;
use App\Models\Qrcode;
use App\Models\Room;
use Illuminate\Http\Request;


class RoomModeratorController extends Controller
{
    public function search(Request $request) {
        $rooms = Room::query();
        $rooms->join('houses', 'houses.id', '=', 'rooms.house_id');
        $rooms->join('users', 'users.id', '=', 'houses.user_id');
        $data = $request->all();

        if ($data['status'] != 'all') {
            $rooms->where('rooms.status',  $data['status']);
        }

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

        $cities = City::all();
        $districts = District::all();
        $rooms->select('rooms.*');
        $rooms = $rooms->paginate($data['paginateNumber'] ?? 12);
        return view('moderator.room.index', compact('rooms', 'cities', 'districts'));
    }

    function index()
    {
        $cities = City::all();
        $districts = District::all();
        $rooms = Room::paginate(12);
        foreach ($rooms as &$room) {
           $qrcode  = Qrcode::where('room_id', $room->id)->first();
             if ($qrcode) {
                 if (file_exists('qrcodes/qrcode_' . $qrcode->id . '.svg')) {
                     $path = 'public/qrcodes/qrcode_' . $qrcode->id . '.svg';
                 } else {
                     $path = public_path('qrcodes/qrcode_' . $qrcode->id . '.svg');
                     \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->style('round')->generate(route('qrcode', $qrcode->id), $path);
                 }
                 $room['qrcode'] = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(35)->style('round')->generate(route('qrcode', $qrcode->id));
                 $room['qrcode_link'] = $path;
             } else {
                 $room['qrcode'] = null;
                 $room['qrcode_link'] = null;
             }

        }
        return view('moderator.room.index', compact('rooms', 'cities', 'districts'));
    }

    function update(Room $room)
    {
        if ($room->status == 'approved') {
            $room->status = 'moderation';
            $room->update();
        } else {
            $room->status = 'approved';
            $room->update();
        }
        $room->update();
        return back();
    }
}
