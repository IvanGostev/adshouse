<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transition;
use App\Models\UserTariff;
use Illuminate\Support\Facades\DB;


class LinkOwnerController extends Controller
{
    function index()
    {
        $links = UserTariff::where('status', 'approved')->paginate(10);
        return view('owner.link.index', compact('links'));
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
        return view('owner.link.statistics', compact('transitionsForChartAdvertiserLink'));
    }
 }
