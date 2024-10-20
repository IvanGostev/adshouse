<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class LinkModeratorController extends Controller
{

    function index()
    {
        $links = UserTariff::where('status', '!=', 'cancelled')->latest()->paginate(12);
        return view('moderator.link.index', compact('links'));
    }

    function approve(UserTariff $link)
    {
        try {
            DB::beginTransaction();
            if ($link->tariff()->type = 'standard') {
            $idsRoomUnsuitable = RoomUserTariff::distinct('room_id')->pluck('room_id')->toArray();
                $rooms = Room::join('houses', 'rooms.house_id', '=', 'houses.id')
                    ->whereNot('rooms.id', $idsRoomUnsuitable)
                    ->where('rooms.condition', 'free')
                    ->where('houses.status', 'approved')
                    ->where('rooms.status', 'approved')
                    ->distinct('houses.id')
                    ->take($link->tariff()->number_rooms)
                    ->select('rooms.*')
                    ->get();
                foreach ($rooms as &$room) {
                    RoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    $room->condition = 'occupied';
                    $room->update();
                }
            } else {
                $rooms = Room::join('houses', 'rooms.house_id', '=', 'houses.id')
                    ->where('rooms.condition', 'free')
                    ->where('houses.status', 'approved')
                    ->where('rooms.status', 'approved')
                    ->distinct('houses.id')
                    ->take($link->tariff()->number_rooms)
                    ->select('rooms.*')
                    ->get();
                foreach ($rooms as &$room) {
                    RoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    if (RoomUserTariff::where('room_id', $room->id)->count() >= 5) {
                        $room->condition = 'occupied';
                        $room->update();
                    }
                }
            }
            $link->status = 'approved';
            $link->finish_date = Carbon::now()->addDays($link->tariff()->days)->toDateTimeString();
            $link->update();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
        }

        return back();
    }


    function refund(UserTariff $link)
    {
        try {
            DB::beginTransaction();
            $link->status = 'cancelled';
            $user = $link->user();
            $user->balance = $user->balance + $link->tariff()->price;
            $user->update();
            BalanceApplication::create([
                'amount' => $link->tariff()->price,
                'type' => 'refund',
                'information' => 'Refund of a tariff, ' . $link->tariff()->title,
                'status' => 'approved',
                'user_id' => $user->id
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
        }
        return back();
    }

    public function statistic(UserTariff $link)
    {
        $transitionsForQrcode = Transition::where('user_tariff_id', $link->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        return view('moderator.qrcode.statistics', compact('transitionsForQrcode'));
    }
}
