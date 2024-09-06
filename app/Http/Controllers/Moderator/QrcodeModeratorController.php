<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\Qrcode;
use App\Models\Room;

use Illuminate\Http\Request;
use Illuminate\View\View;

class QrcodeModeratorController extends Controller
{

    public function index(): View
    {
        $qrcodes = Qrcode::paginate(10);
        foreach ($qrcodes as &$qrcode) {
            $qrcode['qrcode'] = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->style('round')->generate(route('qrcode', $qrcode->id));
        }
        $ids = Qrcode::pluck('room_id')->toArray();
        $rooms = Room::where('status', 'active')->whereNotIn('id', $ids)->get();
        return view('moderator.qrcode.index', compact('qrcodes', 'rooms'));
    }

    public function store(Request $request)
    {
        Qrcode::create();
        return back();
    }

    public function edit(Qrcode $qrcode)
    {
        $ids = Qrcode::pluck('room_id')->toArray();
        $ids = array_filter($ids, function ($element) {
            return $element !== null;
        });
        $rooms = Room::where('status', 'active')->whereNotIn('id', $ids)->get();
        if ($qrcode->room()) {
            $rooms[] = $qrcode->room();
        }

        return view('moderator.qrcode.edit', compact('qrcode', 'rooms'));
    }

    public function update(Qrcode $qrcode, Request $request)
    {
        $qrcode->update(['room_id' => $request->room_id]);
        return redirect()->route('moderator.qrcode.index');
    }

    public function destroy(Qrcode $qrcode)
    {
        $qrcode->delete();
        return back();
    }
}
