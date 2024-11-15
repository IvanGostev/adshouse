<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
use App\Models\HistoryRoomUserTariff;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use Exception;
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
                $rooms = Room::query();
                $rooms->join('houses', 'rooms.house_id', '=', 'houses.id')
                    ->whereNot('rooms.id', $idsRoomUnsuitable)
                    ->where('rooms.condition', 'free')
                    ->where('houses.status', 'approved')
                    ->where('rooms.status', 'approved')
                    ->distinct('houses.id');
                if ($link["country_id"] != null) {
                    $rooms->where('houses.country_id', $link["country_id"]);
                }
                if ($link["city_id"] != null) {
                    $rooms->where('houses.city_id', $link["city_id"]);
                }
                if ($link["district_id"] != null) {
                    $rooms->where('houses.district_id', $link["district_id"]);
                }
                $rooms = $rooms->inRandomOrder()
                    ->take($link->tariff()->number_rooms)
                    ->select('rooms.*')
                    ->get();
                $items = 0;
                foreach ($rooms as &$room) {
                    $items++;
                    RoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    HistoryRoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    $room->condition = 'occupied';
                    $room->update();
                }
                if ($items != $link->tariff()->number_rooms) {
                    throw new Exception("There are not enough rooms");
                }
            } else {
                $rooms = Room::query();
                $rooms->join('houses', 'rooms.house_id', '=', 'houses.id')
                    ->where('rooms.condition', 'free')
                    ->where('houses.status', 'approved')
                    ->where('rooms.status', 'approved')
                    ->distinct('houses.id');
                if ($link["country_id"] != null) {
                    $rooms->where('houses.country_id', $link["country_id"]);
                }
                if ($link["city_id"] != null) {
                    $rooms->where('houses.city_id', $link["city_id"]);
                }
                if ($link["district_id"] != null) {
                    $rooms->where('houses.district_id', $link["district_id"]);
                }
                $rooms = $rooms->inRandomOrder()
                    ->take($link->tariff()->number_rooms)
                    ->select('rooms.*')
                    ->get();
                $items = 0;
                foreach ($rooms as &$room) {
                    $items++;
                    RoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    HistoryRoomUserTariff::create(['user_tariff_id' => $link->id, 'room_id' => $room->id]);
                    if (RoomUserTariff::where('room_id', $room->id)->count() >= 5) {
                        $room->condition = 'occupied';
                        $room->update();
                    }
                    if ($items != $link->tariff()->number_rooms) {
                        throw new Exception("There are not enough rooms");
                    }
                }
            }
            $link->status = 'approved';
            $link->finish_date = Carbon::now()->addDays($link->tariff()->days)->toDateTimeString();
            $link->update();
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            DB::rollback();
        }

        return back();
    }


    function refund(UserTariff $link)
    {
        try {
            DB::beginTransaction();
            $link['status'] = 'cancelled';
            $link->update();
            $user = $link->user();
            $user->balance = $user->balance + $link->tariff()->price;
            $user->update();
            BalanceApplication::create([
                'amount' => $link->tariff()->price,
                'type' => 'refund',
                'method' => 'refund',
                'information' => 'Refund of a tariff, ' . $link->tariff()->title,
                'status' => 'approved',
                'user_id' => $user->id
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
            DB::rollback();
        }
        return back();
    }

    public function statistic(UserTariff $UT)
    {
        $transitionsForQrcode = Transition::where('user_tariff_id', $UT->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        $historyRooms = HistoryRoomUserTariff::where('user_tariff_id', $UT->id)->get()
            ->groupBy(function($events) {
                return Carbon::parse($events->created_at)->format('Y-m-d');
            });
        return view('moderator.qrcode.statistics', compact('transitionsForQrcode', 'historyRooms'));
    }
}
