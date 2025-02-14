<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\BalanceApplication;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;


class PaymentController extends Controller
{

    function createPaymentLink(array $data)
    {
        $headers = [
            'X-Paymennt-Api-Key: 194ac8d76b38f67c',
            'X-Paymennt-Api-Secret: mer_37886b82d29c2137312b444a3a25871f673cf7495822cef463c2f49b4032f764',
            'Content-Type: application/json',
//            'X-Paymennt-Api-Key:19401c1d8febdafb',
//            'X-Paymennt-Api-Secret:mer_c241e43b7d39b8279983258e25791806ea9d03194222632d0dc8c538d597cfc2'

        ];
        $body = [
            "requestId" => str($data['id']) . str(time()) . 'adshouse',
            "orderId" => $data['id'],
            "description" => $data['description'],
            "currency" => $data['currency'],
            "amount" => $data['amount'],
            "sendEmail" => true,
            "customer" => [
                "id" => $data['user_id'],
                "firstName" => $data['first_name'],
                "lastName" => $data['last_name'],
                "email" => $data['email'],
                "phone" => $data['user_id'],
            ],
            "allowedPaymentMethods" => [
                "CARD"
            ],
            "defaultPaymentMethod" => "CARD",
            "expiresIn" => 1440,
            "language" => $data['language']
        ];

        $url = "https://api.paymennt.com/mer/v2.0/checkout/link";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, TRUE);
        if ($res["success"]) {
            return $res['result']['redirectUrl'];

        } else {
            return $res['error'];
        }
    }

    function notification(Request $request)
    {
        $payment = json_decode(json_encode($request->all()));
        if ($payment->status == 'PAID') {
            $ba = BalanceApplication::where('id', $payment->orderId)->first();
            if ($ba and $ba['status'] != 'paid') {
                $ba['status'] = 'paid';
                $user = $ba->user();
                if ($payment->currency == 'USD') {
                    $user['balance'] += $payment->grandtotal;
                    $ba['currency_id'] = 1;
                } else {
                    $currency = Currency::where('title', $payment->currency)->first();
                    if (!$currency) { // error
                        $message = json_encode($request->all());
                        Mail::to('workgostev@gmail.com')->send(new NotificationMail($message));
                        return 'error currency';
                    } else {
                        $user['balance'] += ($payment->grandtotal * $currency->value);
                        $ba['currency_id'] = $currency->id;
                    }
                }
                $ba->update();
                $user->update();
            }
        }
//        $message = implode(',', $request->all());

    }
}
