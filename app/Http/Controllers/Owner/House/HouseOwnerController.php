<?php

namespace App\Http\Controllers\Owner\House;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\House;
use App\Models\Notification;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class HouseOwnerController extends Controller
{
    protected function notification()
    {
        $message = "The apartment has been added for moderation";
        $users = User::where('role', 'moderator')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationMail($message));
        }
        Notification::create(['type' => 'house']);
    }


    function index()
    {
        $houses = House::where('user_id', auth()->user()->id)->latest()->paginate(12);
        return view('owner.house.index', compact('houses'));
    }

    function create()
    {
        $houses = House::where('user_id', auth()->user()->id)->paginate(12);
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        $types = RoomType::all();
        return view('owner.house.create', compact('houses', 'countries', 'cities', 'districts', 'types'));
    }

    function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $types = $data['types'];
        unset($data['types']);

        $data['user_id'] = auth()->user()->id;
        $house = House::create($data);

        foreach ($types as $type) {
            Room::create([
                'house_id' => $house->id,
                'room_type_id' => $type,
                'status' => 'approved'
            ]);
        }
        $this->notification();
        return redirect()->route('owner.house.index');
    }


    function edit(House $house)
    {
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        return view('owner.house.edit', compact('house', 'cities', 'countries', 'districts'));
    }

    function update(House $house, Request $request)
    {
        $data = $request->all();
        $house->status = 'moderation';
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $house->update($data);
        $this->notification();
        return redirect()->route('owner.house.index');
    }

    function delete(House $house)
    {
        $house->delete();
        return back();
    }
}
