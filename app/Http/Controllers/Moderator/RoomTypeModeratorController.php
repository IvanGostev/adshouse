<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomTypeModeratorController extends Controller
{

    public function index(): View
    {
        $types = RoomType::paginate(10);
        return view('moderator.room-type.index', compact('types'));
    }

    public function create() : View {
        return view('moderator.room-type.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:3'],
        ]);
        RoomType::create(['title' => $request->title, 'language' => $request->language]);
        return redirect()->route('moderator.room-type.index');
    }

    public function edit(RoomType $type) : View {
        return view('moderator.room-type.edit', compact('type'));
    }
    public function update(RoomType $type, Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);
        $type->update(['title' => $request->title]);
        return redirect()->route('moderator.room-type.index');
    }
    public function destroy(RoomType $type) : RedirectResponse {
        $type->delete();
        return redirect()->route('moderator.room-type.index');
    }
}
