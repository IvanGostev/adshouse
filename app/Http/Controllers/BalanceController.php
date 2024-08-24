<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\House;
use App\Models\PaymentTransaction;
use App\Models\Region;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BalanceController extends Controller
{
    function show()
    {
        $transactions = PaymentTransaction::where('user_id', auth()->user()->id)->get();
        return view('balance.show', compact('transactions'));
    }

    function handler(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if ($data['type'] == 'replenish') {
                return back();
            } else if ($data['amount'] <= auth()->user()->balance) {
                $user = auth()->user();
                $user->balance = $user->balance - $data['amount'];
                $user->update();
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
        }
        return back();
    }
}
