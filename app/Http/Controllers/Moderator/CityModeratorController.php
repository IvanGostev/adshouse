<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityModeratorController extends Controller
{

    public function index(): View
    {
        $cities = City::paginate(10);
        return view('moderator.city.index', compact('cities'));
    }

    public function create() : View {
        $countries = Country::all();
        $regions = Region::all();
        return view('moderator.city.create', compact('countries', 'regions'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->all();
        if ($data['region_id'] == 0) {
            unset($data['region_id']);
        }
        City::create($data);
        return redirect()->route('moderator.city.index');
    }

    public function edit(City $city) : View {
        $countries = Country::all();
        $regions = Region::all();
        return view('moderator.city.edit', compact('countries', 'regions', 'city'));
    }
    public function update(City $city, Request $request) : RedirectResponse
    {
        $data = $request->all();
        if ($data['region_id'] == 0) {
            unset($data['region_id']);
        }

        $city->update($data);
        return redirect()->route('moderator.city.index');
    }
    public function destroy(City $city) : RedirectResponse {
        $city->delete();
        return redirect()->route('moderator.city.index');
    }
}
