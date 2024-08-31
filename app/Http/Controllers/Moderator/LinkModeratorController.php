<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\UserTariff;


class LinkModeratorController extends Controller
{

    function index()
    {
        $links = UserTariff::where('status', 'moderation')->paginate(12);
        return view('moderator.link.index', compact('links'));
    }

    function update(Room $room)
    {
        $room->status = 'active';
        $room->update();
        return back();
    }
}
