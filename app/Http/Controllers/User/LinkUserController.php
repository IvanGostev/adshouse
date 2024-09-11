<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\Transition;
use App\Models\UserTariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class LinkUserController extends Controller
{
    function index()
    {
        $links = UserTariff::where('status', 'approved')->paginate(10);
        return view('user.link.index', compact('links'));
    }
    public function statistic(UserTariff $link)
    {
        $transitionsForChartAdvertiserLink = Transition::where('user_tariff_id', $link->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        return view('user.link.statistics', compact('transitionsForChartAdvertiserLink'));
    }
 }
