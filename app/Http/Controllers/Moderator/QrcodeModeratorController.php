<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\HistoryRoomUserTariff;
use App\Models\Qrcode;
use App\Models\QrcodeTransition;
use App\Models\Room;

use App\Models\RoomType;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Nette\Utils\Paginator;

class QrcodeModeratorController extends Controller
{

    public function index(Request $request): View
    {
        $data = $request->all();
        $qrcodes = Qrcode::query();
        if (isset($data['status']) and $data['status'] == 'attached') {
            $qrcodes->join('rooms', 'qrcodes.room_id', '=', 'rooms.id')
                ->join('houses', 'houses.id', '=', 'rooms.house_id')
                ->join('users', 'users.id', '=', 'houses.user_id');
            if (isset($data['city_id']) and $data['city_id'] != 'all') {
                $qrcodes->where('houses.city_id', $data['city_id']);
            }
            if (isset($data['country_id']) and $data['country_id'] != 'all') {
                $qrcodes->where('houses.country_id', $data['country_id']);
            }
            if (isset($data['district_id']) and $data['district_id'] != 'all') {
                $qrcodes->where('houses.district_id', $data['district_id']);
            }
            if (isset($data['street']) and $data['street'] != null) {
                $qrcodes->where('houses.street', 'LIKE', "%{$data['street']}%");
            }
            if (isset($data['room_type_id']) and $data['room_type_id'] != 'all') {

                $qrcodes->where('rooms.room_type_id', $data['room_type_id']);
            }
            if (isset($data['email']) and $data['email'] != null) {

                $qrcodes->where('users.email', 'LIKE', "%{$data['email']}%");
            }
        } else {

            $qrcodes->whereNull('room_id');
        }
        $qrcodes = $qrcodes->select('qrcodes.*')->paginate($data['paginateNumber'] ?? 12);

        foreach ($qrcodes as &$qrcode) {
            if (file_exists('qrcodes/qrcode_' . $qrcode->id . '.svg')) {
                $path = 'public/qrcodes/qrcode_' . $qrcode->id . '.svg';
            } else {
                $path = public_path('qrcodes/qrcode_' . $qrcode->id . '.svg');
                \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->style('round')->generate(route('qrcode', $qrcode->id), $path);
            }
            $qrcode['qrcode'] = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(35)->style('round')->generate(route('qrcode', $qrcode->id));
            $qrcode['link'] = $path;
        }


        $cities = City::all();
        $countries = Country::all();
        $districts = District::all();
        $types = RoomType::all();
        return view('moderator.qrcode.index', compact('qrcodes', 'cities', 'countries', 'districts', 'types'));
    }

    public function store(Request $request)
    {
        Qrcode::create();
        return back();
    }

    public function search(Request $request, Qrcode $qrcode)
    {
        $rooms = Room::query();
        $rooms->join('houses', 'houses.id', '=', 'rooms.house_id');
        $rooms->join('users', 'users.id', '=', 'houses.user_id');
        $data = $request->all();

        if ($data['city_id'] != 'all') {
            $rooms->where('houses.city_id', $data['city_id']);
        }

        if ($data['district_id'] != 'all') {
            $rooms->where('houses.district_id', $data['district_id']);
        }

        if (isset($data['street'])) {
            $rooms->where('houses.street', 'LIKE', "%{$data['street']}%");
        }
        if (isset($data['email'])) {
            $rooms->where('users.email', 'LIKE', "%{$data['email']}%");
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
        $rooms = Room::where('status', 'approved')->whereNotIn('id', $ids)->paginate(10);
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
        $transitions = QrcodeTransition::where('qrcode_id', $qrcode->id)->get();
        foreach ($transitions as $transition) {
            $transition->delete();
        }
        $qrcode->delete();
        return back();
    }

    public function statistic(Qrcode $qrcode)
    {
        $transitionsForChartAdvertiserLink = QrcodeTransition::where('qrcode_id', $qrcode->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        $historyRooms = HistoryRoomUserTariff::join('qrcodes', 'qrcodes.room_id', '=', 'history_room_user_tariffs.room_id')
            ->where('qrcodes.id', $qrcode->id)
            ->select('history_room_user_tariffs.*')
            ->get()
            ->groupBy(function ($events) {
                return Carbon::parse($events->created_at)->format('Y-m-d');
            });
        $links = HistoryRoomUserTariff::join('qrcodes', 'qrcodes.room_id', '=', 'history_room_user_tariffs.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'history_room_user_tariffs.user_tariff_id')
            ->where('qrcodes.id', $qrcode->id)
            ->select('user_tariffs.url', "history_room_user_tariffs.*")
            ->get()
            ->groupBy(function ($events) {
                return Carbon::parse($events->created_at)->format('Y-m-d');
            });
        return view('moderator.link.statistics', compact('transitionsForChartAdvertiserLink', 'historyRooms', 'links'));
    }
}
