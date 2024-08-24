<?php

namespace App\Http\Controllers\User\House;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
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
        $regions = Region::all();
        $cities = City::all();
        return view('user.house.create', compact('houses', 'countries', 'regions', 'cities'));
    }

    function store(Request $request)
    {
        $data = $request->all();
        if ($data['region_id'] == 0) {
            unset($data['region_id']);
        }
        if (isset($data['img'])) {
            $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
        }
        $data['user_id'] = auth()->user()->id;
        House::create($data);
        return redirect()->route('user.house.index');
    }
}
