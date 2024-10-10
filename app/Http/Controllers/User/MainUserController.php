<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
use App\Models\Transition;
use App\Models\UserTariff;
use Carbon\Carbon;
use GeoIp2\Record\Location;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;


class MainUserController extends Controller
{
    public function index()
    {
        $numberTransitionsToday = Transition::where('user_id', auth()->user()->id)
            ->whereDate('created_at', '=', Carbon::now()->toDateString())
            ->count();

        $numberTransitionsWeek = Transition::where('user_id', auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())
            ->count();

        $numberTransitionsMonth = Transition::where('user_id', auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->count();

        $transitionsForChartAdvertiser = Transition::where('user_id', auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));

        $incomeToday = array_sum(BalanceApplication::where('user_id', auth()->user()->id)
            ->where('type', 'cashback')
            ->whereDate('created_at', '=', Carbon::now()->toDateString())
            ->pluck('amount')->toArray());
        $incomeAll = array_sum(BalanceApplication::where('user_id', auth()->user()->id)
            ->where('type', 'cashback')
            ->pluck('amount')->toArray());;
        return view('user.main.index',
            compact('numberTransitionsToday', 'numberTransitionsWeek', 'numberTransitionsMonth', 'transitionsForChartAdvertiser', 'incomeToday', 'incomeAll'));
    }
}
