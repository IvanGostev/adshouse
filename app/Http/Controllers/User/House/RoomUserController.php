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

    function store(House $house, Request $request)
    {
        $data = $request->all();
        $data['house_id'] = $house->id;
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        Room::create($data);
        return redirect()->route('user.room.index', $house->id);
    }

    function edit(Room $room)
    {
        $types = RoomType::all();
        $slug = 'country:' . $room->house()->country()->title . '&city:' . $room->house()->city()->title . '&district:' . $room->house()->district . '&street:' . $room->house()->street . '&numberhouse:' . $room->house()->number . '&apartmentnumber:' . $room->house()->apartment_number;
        $qrcode = QrCode::size(240)->style('round')->generate(route('ads', ['room' => $room->id, 'slug' => $slug]));

        return view('user.room.edit', compact('room', 'types', 'slug', 'qrcode'));
    }

    function update(Room $room, Request $request)
    {
        $data = $request->all();
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $room->status = 'moderation';
        $room->update($data);
        return redirect()->route('user.room.index', $room->house()->id);
    }
}
