<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\House;


class HouseModeratorController extends Controller
{
    function index()
    {
        $houses = House::where('status', 'moderation')->paginate(12);
        return view('moderator.house.index', compact('houses'));
    }

    function update(House $house)
    {
        $house->status = 'active';
        $house->update();
        return back();
    }
}
