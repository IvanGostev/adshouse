<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use GeoIp2\Record\Location;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;


class MainAdvertiserController extends Controller
{
    public function index()
    {


        $numberTransitionsToday = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '=',  Carbon::now()->toDateString())
            ->select('transitions.*')->count();


        $numberTransitionsWeek = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
            ->select('transitions.*')->count();

        $numberTransitionsMonth = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->select('transitions.*')->count();

        $browsers = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->groupBy('browser')
            ->get(array(
                DB::raw('browser as title'),
                DB::raw('COUNT(*) as "count"')
            ));


        $transitionsForChartAdvertiser = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(transitions.created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        $transitionsForChartLastAdvertiser = Transition::join('room_user_tariffs', 'room_user_tariffs.room_id', '=', 'transitions.room_id')
            ->join('user_tariffs', 'user_tariffs.id', '=', 'room_user_tariffs.user_tariff_id')
            ->where('user_tariffs.user_id', auth()->user()->id)
            ->whereDate('transitions.created_at', '<=', Carbon::now()->subDays(30)->toDateTimeString())
            ->whereDate('transitions.created_at', '>=', Carbon::now()->subDays(60)->toDateTimeString())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(transitions.created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        return view('advertiser.main.index',
            compact('numberTransitionsToday', 'numberTransitionsWeek', 'numberTransitionsMonth', 'browsers', 'transitionsForChartAdvertiser', 'transitionsForChartLastAdvertiser'));
    }
}
