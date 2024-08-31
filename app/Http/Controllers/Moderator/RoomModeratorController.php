<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Qrcode;
use App\Models\Room;


class RoomModeratorController extends Controller
{

    function index()
    {
        $rooms = Room::where('status', 'moderation')->paginate(12);
        return view('moderator.room.index', compact('rooms'));
    }

    function update(Room $room)
    {
        $room->status = 'active';
        $room->update();
        return back();
    }
}
