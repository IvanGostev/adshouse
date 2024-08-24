<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Street;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StreetModeratorController extends Controller
{

    public function index(): View
    {
        $streets = Street::paginate(10);
        return view('moderator.street.index', compact('streets'));
    }

    public function create() : View {
        $cities = City::all();
        return view('moderator.street.create', compact('cities'));
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->all();
        Street::create($data);
        return redirect()->route('moderator.street.index');
    }

    public function edit(Street $street) : View {
        $cities = City::all();
        return view('moderator.street.edit', compact('cities', 'street'));
    }
    public function update(Street $street, Request $request) : RedirectResponse
    {
        $data = $request->all();
        $street->update($data);
        return redirect()->route('moderator.street.index');
    }
    public function destroy(Street $street) : RedirectResponse {
        $street->delete();
        return redirect()->route('moderator.street.index');
    }
}
