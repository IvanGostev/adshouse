<?php

namespace App\Http\Controllers\User\House;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\House;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HouseUserController extends Controller
{
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
        return redirect()->route('user.house.index');
    }
 }
