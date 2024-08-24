<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\Region;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\UserTariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdsController extends Controller
{
    function ads(Room $room, string $slug)
    {
        $obj = RoomUserTariff::where('room_id', $room)->first();

        if ($obj) {
            $UT = UserTariff::where('id', $obj->user_tariff_id)->first();
            return redirect($UT->url)->with(['room_id' => $obj->room_id]);
        }

        return redirect('/');
    }

}
