<?php

namespace App\Http\Controllers;

use App\Models\BalanceApplication;
use App\Models\PaymentTransaction;
use App\Models\Qrcode;
use App\Models\QrcodeTransition;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Transition;
use App\Models\UserTariff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Jenssegers\Agent\Facades\Agent;

class AdsController extends Controller
{
    function ads(Room $room, string $slug)
    {
        $RUT = RoomUserTariff::where('room_id', $room->id)->first();
        if ($RUT) {
            $UT = UserTariff::where('id', $RUT->user_tariff_id)->first();
            if (!request()->hasCookie('ut_' . $UT->id)) {

                Cookie::queue('ut_' . $UT->id, 'yes', 60 * 60 * 2);
                $tariff = $UT->tariff();

                $transition = [
                    'room_id' => $room->id,
                    'user_tariff_id' => $UT->id,
                    'browser' => Agent::browser()
                ];

                if ($tariff->method == 'transitions') {
                    $UT['fulfilled_transitions'] = $UT['fulfilled_transitions'] + 1;
                    $UT->update();
                    if ($UT['fulfilled_transitions'] > $tariff->transitions) {
                        $RUTs = RoomUserTariff::where('user_tariff_id', $UT->id)->get();
                        $rooms = $UT->rooms();
                        foreach ($rooms as $room) {
                            $room["condition"] = 'free';
                            $room->update();
                        }
                        foreach ($RUTs as $RUT) {
                            $RUT->delete();
                        }
                        $UT->delete();
                        return redirect('/');
                    }
                }


                if (Auth::check()) {
                    $user = auth()->user();
                    $transition['user_id'] = $user->id;
                    // Update balance for user

                    if ($tariff->method == 'rooms') {
                        $addSum = $tariff->amount_user;
                    } else if ($tariff->method == 'transitions') {
                        $priceTransition = $tariff->price / $tariff->transitions;
                        $addSum = ($tariff->percent_user / 100) * $priceTransition;
                    }
                    $user->balance = $user->balance + $addSum;
                    $user->update();

                    BalanceApplication::create([
                        'amount' => $addSum,
                        'type' => 'cashback',
                        'method' => 'cashback',
                        'user_id' => $user->id,
                        'status' => 'approved'
                    ]);
                }
                $transition = Transition::create($transition);


                // Update balance for owner
                $user = $RUT->room()->house()->user();
                if ($tariff->method == 'rooms') {
                    $addSum = $tariff->amount_owner;
                } else if ($tariff->method == 'transitions') {
                    $addSum = ($tariff->percent_owner / 100) * $priceTransition;
                }


                $user->balance = $user->balance + $addSum;
                $user->update();

                BalanceApplication::create([
                    'transition_id' => $transition->id,
                    'currency_id' => 1,
                    'amount' => $addSum,
                    'type' => 'transition link',
                    'method' => 'transition link',
                    'user_id' => $user->id,
                    'status' => 'approved'
                ]);
            }
            if ($UT->tariff()->type == 'standard') {
                return redirect($UT->url)->with(['room_id' => $room->id]);
            } else {
                $UTs = RoomUserTariff::join('user_tariffs', 'room_user_tariffs.user_tariff_id', '=', 'user_tariffs.id')
                    ->where('room_user_tariffs.room_id', $room->id)
                    ->select('user_tariffs.*')
                    ->get();
                return view('advertiser-url', compact('UTs'));
            }
        }
        return redirect('https://adshouse.ae/');
    }

    public function qrcode(Qrcode $qrcode)
    {
        QrcodeTransition::create(['qrcode_id' => $qrcode->id]);
        $room = Room::where('id', $qrcode->room_id)->first();
        if ($room) {
            return redirect()->route('ads', ['room' => $room->id, 'slug' => 'qrcode']);
        } else {
            return back();
        }
    }
}
