<?php

namespace App\Http\Controllers\Owner\House;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\Notification;
use App\Models\Room;
use App\Models\House;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Note;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RoomOwnerController extends Controller
{

    protected function notification()
    {
        $message = "The room has been added for moderation";
        $users = User::where('role', 'moderator')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationMail($message));
        }
        Notification::create(['type' => 'room']);
    }

    function index(House $house)
    {
        $rooms = Room::where('house_id', $house->id)->latest()->paginate(12);
        return view('owner.room.index', compact('rooms', 'house'));
    }

    function create(House $house)
    {
        $types = RoomType::all();
        return view('owner.room.create', compact('house', 'types'));
    }

    function store(House $house, Request $request)
    {
        $data = $request->all();
        $data['house_id'] = $house->id;
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $data['status'] = 'approved';
        Room::create($data);
        return redirect()->route('owner.room.index', $house->id);
    }

    function edit(Room $room)
    {
        $types = RoomType::all();
        $slug = 'country:' . $room->house()->country()->title . '&city:' . $room->house()->city()->title . '&district:' . $room->house()->district()->title . '&street:' . $room->house()->street . '&numberhouse:' . $room->house()->number . '&apartmentnumber:' . $room->house()->apartment_number;
        $qrcode = QrCode::size(500)->style('round')->generate(route('ads', ['room' => $room->id, 'slug' => $slug]));
        $house = $room->house();
        return view('owner.room.edit', compact('room', 'types', 'slug', 'qrcode', 'house'));
    }

    function update(Room $room, Request $request)
    {
        $data = $request->all();
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $room->status = 'approved';
        $room->update($data);
        return redirect()->route('owner.room.index', $room->house()->id);
    }

    function delete(Room $room)
    {
        $room->delete();
        return back();
    }
}
