<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\Tariff;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TariffModeratorController extends Controller
{

    public function index(): View
    {
        $tariffs = Tariff::paginate(10);
        return view('moderator.tariff.index', compact('tariffs'));
    }

    public function create() : View {
        return view('moderator.tariff.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $data = $request->all();
        Tariff::create($data);
        return redirect()->route('moderator.tariff.index');
    }

    public function edit(Tariff $tariff) : View {

        return view('moderator.tariff.edit', compact('tariff'));
    }
    public function update(Tariff $tariff, Request $request) : RedirectResponse
    {
        $data = $request->all();
        $tariff->update($data);
        return redirect()->route('moderator.tariff.index');
    }
    public function destroy(Tariff $tariff) : RedirectResponse {
        $tariff->delete();
        return redirect()->route('moderator.tariff.index');
    }
}
