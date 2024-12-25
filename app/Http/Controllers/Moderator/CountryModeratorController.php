<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CountryModeratorController extends Controller
{

    public function index(): View
    {
        $countries = Country::paginate(10);
        return view('moderator.country.index', compact('countries'));
    }

    public function create() : View {
        return view('moderator.country.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:3'],
        ]);

        Country::create(['title' => $request->title, 'language' => $request->language]);
        return redirect()->route('moderator.country.index');
    }

    public function edit(Country $country) : View {
        return view('moderator.country.edit', compact('country'));
    }
    public function update(Country $country, Request $request) : RedirectResponse
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $country->update(['title' => $request->title]);
        return redirect()->route('moderator.country.index');
    }
    public function destroy(Country $country) : RedirectResponse {
        $country->delete();
        return redirect()->route('moderator.country.index');
    }
}
