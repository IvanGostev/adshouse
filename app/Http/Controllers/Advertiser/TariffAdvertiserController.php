<?php

namespace App\Http\Controllers\Advertiser;


use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TariffAdvertiserController extends Controller
{

    public function index(): View
    {
        $numberFreeRooms = Room::where('status', 'active')->where('condition', 'free')->count();
        $tariffs = Tariff::where('number_rooms', '<=', $numberFreeRooms)->paginate(10);
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
            BalanceApplication::create([
                'amount' => $tariff->price,
                'type' => 'purchase',
                'information' => 'Purchase of a tariff, ' . $tariff->title,
                'status' => 'approved',
                'user_id' => $user->id
            ]);
            $data['user_id'] = $user->id;
            $data['tariff_id'] = $tariff->id;
            $data['url'] = $request->url;
            if (isset($request['img'])) {
                $data['img'] = '/storage/' . Storage::disk('public')->put('/images', $data['img']);
            }
            UserTariff::create($data);
            DB::commit();
            return redirect()->route('advertiser.tariff.my');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('balance.show');
        }
    }


}
