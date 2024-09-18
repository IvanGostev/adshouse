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
        $transactions = BalanceApplication::where('user_id', auth()->user()->id)->get();
        return view('balance.show', compact('transactions'));
    }

    function handler(Request $request)
    {
        $data = $request->validate([
            'type' => ['string', Rule::in(['replenish', 'withdraw'])],
            'amount' => ['required'],
            'information' => ['string', 'required']
        ]);
        if ($data['type'] == 'withdraw') {
            $user = auth()->user();
            if ($user->balance >= $data['amount']) {
                $user->balance = $user->balance - $data['amount'];
            }
            else {
                return back();
            }
        }
        try {
            DB::beginTransaction();
            BalanceApplication::create([
                'amount' => $data['amount'],
                'type' => $data['type'],
                'information' => $data['information'],
                'status' => 'moderation',
                'user_id' => auth()->user()->id
            ]);
            DB::commit();

            $message = "Confirm the payment transaction";
            $users = User::where('role', 'moderator')->get();
            foreach($users as $user) {
                Mail::to($user->email)->send(new NotificationMail($message));
            }
            Notification::create(['type' => 'balance']);
        } catch (Exception $exception) {
            DB::rollback();
        }
        return back();
    }
}
