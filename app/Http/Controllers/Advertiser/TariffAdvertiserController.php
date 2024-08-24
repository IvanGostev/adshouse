<?php

namespace App\Http\Controllers\Advertiser;


use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Tariff;
use App\Models\Country;
use App\Models\Region;
use App\Models\UserTariff;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TariffAdvertiserController extends Controller
{

    public function index(): View
    {
        $tariffs = Tariff::paginate(10);
        return view('advertiser.tariff.index', compact('tariffs'));
    }

    public function my(): View
    {
        $tariffs = Tariff::join('user_tariffs', 'tariffs.id', '=', 'user_tariffs.tariff_id')
            ->where('user_tariffs.user_id', '=', auth()->user()->id)
            ->select('tariffs.*', 'user_tariffs.url')
            ->get();
        return view('advertiser.tariff.my', compact('tariffs'));
    }

    public function bye(Request $request, Tariff $tariff): RedirectResponse
    {
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if (!($tariff->price <= $user->balance)) {
                throw new Exception();
            }
            $user->balance = $user->balance - $tariff->price;
            $user->update();
            $UT = UserTariff::create(['user_id' => $user->id, 'tariff_id' => $tariff->id, 'url' => $request->url]);

            $rooms = Room::join('houses', 'rooms.house_id', '=', 'houses.id')
                ->where('rooms.status', 'free')
                ->distinct('houses.id')
                ->take($tariff->number_rooms)
                ->select('rooms.*')
                ->get();
            foreach ($rooms as &$room) {
                RoomUserTariff::create(['user_tariff_id' => $UT->id, 'room_id' => $room->id]);
                $room->status = 'occupied';
                $room->update();
            }
            DB::commit();
            return redirect()->route('advertiser.tariff.my');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('balance.show');
        }
    }


}
