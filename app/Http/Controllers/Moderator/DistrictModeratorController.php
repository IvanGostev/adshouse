<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\City;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DistrictModeratorController extends Controller
{

    public function index(): View
    {
        $districts = District::paginate(10);
        return view('moderator.district.index', compact('districts'));
    }

    public function create() : View {
        $cities = City::all();
        return view('moderator.district.create', compact('cities'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->all();
        District::create($data);
        return redirect()->route('moderator.district.index');
    }

    public function edit(District $district) : View {
        $cities = City::all();
        return view('moderator.district.edit', compact('cities','district'));
    }
    public function update(District $district, Request $request) : RedirectResponse
    {
        $data = $request->all();
        $district->update($data);
        return redirect()->route('moderator.district.index');
    }
    public function destroy(District $district) : RedirectResponse {
        $district->delete();
        return redirect()->route('moderator.district.index');
    }
}
