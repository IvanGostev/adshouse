<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CurrencyModeratorController extends Controller
{

    public function index(): View
    {
        $currencies = Currency::paginate(10);
        return view('moderator.currency.index', compact('currencies'));
    }

    public function create() : View {
        return view('moderator.currency.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required'],
        ]);
        $data = $request->all();
        Currency::create($data);
        return redirect()->route('moderator.currency.index');
    }

    public function edit(Currency $currency) : View {
        return view('moderator.currency.edit', compact('currency'));
    }
    public function update(Currency $currency, Request $request) : RedirectResponse
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'value' => ['required'],
        ]);
        $data  = $request->all();
        $currency->update($data);
        return redirect()->route('moderator.currency.index');
    }
    public function destroy(Currency $currency) : RedirectResponse {
        $currency->delete();
        return redirect()->route('moderator.currency.index');
    }
}
