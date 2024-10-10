<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
use App\Models\House;
use App\Models\Room;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use GeoIp2\Record\Location;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;


class MainOwnerController extends Controller
{
    public function index()
    {


        $numberTransitionsToday = Transition::join('rooms', 'rooms.id', '=', 'transitions.room_id')
            ->join('houses', 'houses.id', '=', 'rooms.house_id')
            ->where('houses.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '=',  Carbon::now()->toDateString())
            ->select('transitions.*')->count();

        $apartments = House::where('user_id', auth()->user()->id)->get();

        foreach ($apartments as &$apartment) {
            $roomsIds = Room::where('house_id', $apartment->id)->pluck('id')->toArray();
            $apartment['numberTransitionsToday'] = Transition::whereIn('room_id', $roomsIds)
                ->whereDate('created_at', '=',  Carbon::now()->toDateString())
                ->count();
            $apartment['numberTransitionsWeek'] = Transition::whereIn('room_id', $roomsIds)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
                ->count();
            $apartment['numberTransitionsMonth'] = Transition::whereIn('room_id', $roomsIds)
                ->whereDate('transitions.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->count();
            $apartment['transitionsForChart'] = Transition::whereIn('room_id', $roomsIds)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as "views"')
                ))->toArray();
        }

        $incomeWeek = array_sum(BalanceApplication::where('user_id', auth()->user()->id)
            ->where('type', 'transition link')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())
            ->pluck('amount')->toArray());

        $incomeAll = array_sum(BalanceApplication::where('user_id', auth()->user()->id)
            ->where('type', 'transition link')
            ->pluck('amount')->toArray());
        $links = UserTariff::where('status', 'approved')->paginate(10);
        return view('owner.main.index',
            compact('numberTransitionsToday', 'incomeWeek', 'incomeAll', 'apartments', 'links'));
    }
}
