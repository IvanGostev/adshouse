<?php

namespace App\Http\Controllers\Advertiser;


use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\BalanceApplication;
use App\Models\Notification;
use App\Models\Room;
use App\Models\RoomUserTariff;
use App\Models\Tariff;
use App\Models\Country;
use App\Models\Region;
use App\Models\Transition;
use App\Models\User;
use App\Models\UserTariff;
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
        $numberFreeRooms = Room::where('status', 'approved')->where('condition', 'free')->count();

        $tariffs = Tariff::where('number_rooms', '<=', $numberFreeRooms)->paginate(10);
        return view('advertiser.tariff.index', compact('tariffs'));
    }

    public function my(): View
    {
        $tariffs = Tariff::join('user_tariffs', 'tariffs.id', '=', 'user_tariffs.tariff_id')
            ->where('user_tariffs.user_id', '=', auth()->user()->id)
            ->select('tariffs.*', 'user_tariffs.url', 'user_tariffs.id', 'user_tariffs.img')
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
        return view('advertiser.tariff.statistics', compact('transitionsForChartAdvertiserLink'));
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
                'user_id' => $user->id,
                'method' => 'Internal purchase'
            ]);
            $data['user_id'] = $user->id;
            $data['tariff_id'] = $tariff->id;
            $data['url'] = $request->url;
            if (isset($request['img'])) {
                $data['img'] = 'storage/' . Storage::disk('public')->put('/images', $request['img']);
            }
            UserTariff::create($data);
            $message = "The tariff has been purchased, check the advertiser's link";
            $users = User::where('role', 'moderator')->get();
            foreach($users as $user) {
                Mail::to($user->email)->send(new NotificationMail($message));
            }
            Notification::create(['type' => 'link']);

            DB::commit();
            return redirect()->route('advertiser.tariff.my');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            DB::rollBack();
            return redirect()->route('balance.show');
        }
    }


}
