<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegionModeratorController extends Controller
{

    public function index(): View
    {
        $regions = Region::paginate(10);
        return view('moderator.region.index', compact('regions'));
    }

    public function create() : View {
        $countries = Country::all();
        return view('moderator.region.create', compact('countries'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->all();
        Region::create($data);
        return redirect()->route('moderator.region.index');
    }

    public function edit(Region $region) : View {
        $countries = Country::all();
        return view('moderator.region.edit', compact('countries', 'region'));
    }
    public function update(Region $region, Request $request) : RedirectResponse
    {
        $data = $request->all();
        $region->update($data);
        return redirect()->route('moderator.region.index');
    }
    public function destroy(Region $region) : RedirectResponse {
        $region->delete();
        return redirect()->route('moderator.region.index');
    }
}
