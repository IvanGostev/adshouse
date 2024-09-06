<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\Qrcode;
use App\Models\Region;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Transition;
use App\Models\UserTariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdsController extends Controller
{
    function ads(Room $room, string $slug)
    {
        $obj = RoomUserTariff::where('room_id', $room->id)->first();

        if ($obj) {
            $UT = UserTariff::where('id', $obj->user_tariff_id)->first();
            Transition::create(['user_tariff_id' => $UT->id]);
            if ($UT->type = 'standard') {
                return redirect($UT->url)->with(['room_id' => $room->id]);
            } else {
                $UTs = RoomUserTariff::join('user_tariffs', 'room_user_tariffs.user_tariff_id', '=', 'user_tariffs.id')
                    ->where('room_user_tariffs.room_id', $room->id)
                    ->select('user_tariffs.*')
                    ->get();
                return view('advertiser-url', compact('UTs'));
            }

        }

        return redirect('/');
    }

    public function qrcode(Qrcode $qrcode)
    {
        $room = Room::where('qrcode_id', $qrcode->id)->first();
        if ($room) {
            return redirect()->route('ads', ['room' => $room->id, 'slug' => 'qrcode']);
        } else {
            return back();
        }
    }
}
