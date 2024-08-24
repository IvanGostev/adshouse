<?php

namespace App\Http\Controllers\User\House;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\House;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RoomUserController extends Controller
{
    function index(House $house)
    {
        $rooms = Room::where('house_id', $house->id)->paginate(12);
        return view('user.room.index', compact('rooms', 'house'));
    }

    function create(House $house)
    {
        $types = RoomType::all();
        return view('user.room.create', compact('house', 'types'));
    }

    function store(House $house ,Request $request)
    {
        $data = $request->all();
        $data['house_id'] = $house->id;
        $data['slug'] = $house->id;
        Room::create($data);
        return redirect()->route('user.room.index', $house->id);
    }
    function edit(Room $room)
    {
        $types = RoomType::all();
        // ->merge('/public/images/placeholder.png', .4)
//        $qrcode = QrCode::size(200)->format('png')->generate('https://www.binaryboxtuts.com/');
        $slug = 'country&' . $room->house()->country()->title . '&city' . $room->house()->city()->title . '&numberhouse' . $room->house()->number . '&apartment_number' . $room->house()->apartment_number;
        return view('user.room.edit', compact('room', 'types'));
    }

    function update(House $room ,Request $request)
    {
        $data = $request->all();
        $room->update($data);

        return redirect()->route('user.room.index', $room->house_id);
    }
}
