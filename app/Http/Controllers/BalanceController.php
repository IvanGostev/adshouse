<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\NotificationMail;
use App\Models\BalanceApplication;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\Notification;
use App\Models\PaymentTransaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class BalanceController extends Controller
{
    function show()
    {
        $transactions = BalanceApplication::where('user_id', auth()->user()->id)->latest()->get();
        return view('balance.show', compact('transactions'));
    }

    function handler(Request $request)
    {

        $data = $request->validate([
            'type' => ['string', Rule::in(['replenish', 'withdraw'])],
            'amount' => ['required'],
            'method' => ['required', Rule::in(['account', 'online'])],
            'information' => ['string', 'nullable']
        ]);

        $data['amount'] = $data['amount'] / activeCountry()->currency()->value;
        $user = auth()->user();
        if ($data['type'] == 'withdraw') {
            if ($user->balance >= $data['amount']) {
                $user->balance = $user->balance - $data['amount'];
                $user->update();
            } else {
                return back();
            }
        }
        try {
            DB::beginTransaction();
            $store = [
                'amount' => $data['amount'],
                'currency_id' => activeCountry()->currency()->id,
                'type' => $data['type'],
                'method' => $data['method'],
                'information' => $data['information'],
                'user_id' => auth()->user()->id
            ];
            if ($data['method'] == 'account') {
                $store['status'] = 'moderation';
            } else {
                $store['status'] = 'awaiting a response';
            }
            $ba = BalanceApplication::create($store);

            if ($data['method'] == 'online') {
                $payment = new PaymentController();
                $transaction = [
                    'id' => $ba->id,
                    'user_id' => $user->id,
                    'amount' => $store['amount'],
                    'currency' => activeCountry()->currency()->title,
                    'description' => 'Adding funds to your account',
                    'first_name' => $user['name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'language' => activeCountry()->lanaguage
                ];
                $res = $payment->createPaymentLink($transaction);
            } else {
                $res = 'back';
            }
            $message = "Confirm the payment transaction";
            $users = User::where('role', 'moderator')->get();
            foreach ($users as $userBD) {
                Mail::to($userBD->email)->send(new NotificationMail($message));
            }
            if ($data['method'] != 'online') {
                Notification::create(['type' => 'balance']);
            }
            DB::commit();
        } catch (Exception $exception) {
            dd($exception->getMessage());
            DB::rollback();
        }
        if ($res == 'back') {
            return back();
        } else {
            $arr = explode('/', $res);
            return redirect()->to('https://pay.paymennt.com/hosted/pay?checkoutKey=' . $arr[4]);
        }

    }
}
