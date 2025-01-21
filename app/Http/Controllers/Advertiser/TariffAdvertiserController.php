<?php

namespace App\Http\Controllers\Advertiser;


use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\BalanceApplication;
use App\Models\City;
use App\Models\District;
use App\Models\HistoryRoomUserTariff;
use App\Models\Notification;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Tariff;
use App\Models\Country;
use App\Models\Region;
use App\Models\Transition;
use App\Models\User;
use App\Models\UserTariff;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TariffAdvertiserController extends Controller
{

    public function index(): View
    {
        $lan = session()->has('language') ? session()->get('language') : 'en';
        $numberFreeRooms = Room::where('status', 'approved')->where('condition', 'free')->count();
        $tariffs = Tariff::where('language', $lan)->where('number_rooms', '<=', $numberFreeRooms)->paginate(10);
        $countries = Country::where('language', $lan)->get();
        $cities = City::where('language', $lan)->get();
        $districts = District::where('language', $lan)->get();
        return view('advertiser.tariff.index', compact('tariffs', 'countries', 'cities', 'districts'));
    }

    public function my(): View
    {
        $tariffs = Tariff::join('user_tariffs', 'tariffs.id', '=', 'user_tariffs.tariff_id')
            ->where('user_tariffs.user_id', '=', auth()->user()->id)
            ->where('user_tariffs.status', '!=', 'cancelled')
            ->select('tariffs.*', 'user_tariffs.url', 'user_tariffs.id', 'user_tariffs.img', 'user_tariffs.fulfilled_transitions', 'user_tariffs.deleted_at')
            ->latest()
            ->get();
        return view('advertiser.tariff.my', compact('tariffs'));
    }

    public function show(UserTariff $UT)
    {
        $transitionsForChartAdvertiserLink = Transition::where('user_tariff_id', $UT->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "views"')
            ));
        $historyRooms = HistoryRoomUserTariff::where('user_tariff_id', $UT->id)->get()
            ->groupBy(function($events) {
                return Carbon::parse($events->created_at)->format('Y-m-d');
            });
        return view('advertiser.tariff.statistics', compact('transitionsForChartAdvertiserLink', 'historyRooms'));
    }

    public function bye(Request $request, Tariff $tariff): RedirectResponse
    {
        $user = auth()->user();
        $count = $request->count ?? 1;
        while($count > 0) {
            try {
                DB::beginTransaction();

                if (!($tariff->price <= $user->balance)) {
                    throw new Exception();
                }
                $user->balance = $user->balance - $tariff->price;
                $user->update();

                BalanceApplication::create([
                    'amount' => $tariff->price,
                    'currency_id' => 1,
                    'type' => 'purchase',
                    'information' => 'Purchase of a tariff, ' . $tariff->title,
                    'status' => 'approved',
                    'user_id' => $user->id,
                    'method' => 'Internal purchase'
                ]);
                $data['user_id'] = $user->id;
                $data['tariff_id'] = $tariff->id;
                $data['url'] = $request->url;
                if ($request['country_id'] != 'all') {
                    $data['country_id'] = $request->country_id;
                }
                if ($request['city_id'] != 'all') {
                    $data['city_id'] = $request->city_id;
                }
                if ($request['district_id'] != 'all') {
                    $data['district_id'] = $request->district_id;
                }
                if (isset($request['img'])) {
                    $data['img'] = 'storage/' . Storage::disk('public')->put('/images', $request['img']);
                }
                UserTariff::create($data);
                $message = "The tariff has been purchased, check the advertiser's link";
                $users = User::where('role', 'moderator')->get();
                foreach ($users as $user) {
                    Mail::to($user->email)->send(new NotificationMail($message));
                }
                Notification::create(['type' => 'link']);
                DB::commit();
            } catch (Exception $exception) {
                DB::rollBack();
//                dd($exception->getMessage());
                return redirect()->route('balance.show');
            }
            $count--;
        }
        return redirect()->route('advertiser.tariff.my');
    }


}
