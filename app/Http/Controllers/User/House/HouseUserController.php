<?php

namespace App\Http\Controllers\User\House;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\House;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class HouseUserController extends Controller
{
    protected function notification() {
        $message = "The apartment has been added for moderation";
        $users = User::where('role', 'moderator')->get();
        foreach($users as $user) {
            Mail::to($user->email)->send(new NotificationMail($message));
        }
        Notification::create(['type' => 'house']);
    }


    function index()
    {
        $houses = House::where('user_id', auth()->user()->id)->paginate(12);
        return view('user.house.index', compact('houses'));
    }

    function create()
    {
        $houses = House::where('user_id', auth()->user()->id)->paginate(12);
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        return view('user.house.create', compact('houses', 'countries', 'cities', 'districts'));
    }

    function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $data['user_id'] = auth()->user()->id;
        House::create($data);
        $this->notification();
        return redirect()->route('user.house.index');
    }


    function edit(House $house) {
        $countries = Country::all();
        $cities = City::all();
        $districts = District::all();
        return view('user.house.edit', compact('house', 'cities', 'countries', 'districts'));
    }

    function update(House $house, Request $request) {
        $data = $request->all();
        $house->status = 'moderation';
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $house->update($data);
        $this->notification();
        return redirect()->route('user.house.index');
    }
    function delete(House $house) {
        $house->delete();
        return back();
    }
 }
