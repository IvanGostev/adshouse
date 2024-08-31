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
        Qrcode::create(['room_id' => $request->room_id]);
        return back();
    }
}
