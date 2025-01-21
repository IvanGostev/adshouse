<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\BalanceApplication;
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
            'Content-Type: application/json',
            'X-Paymennt-Api-Key:19401c1d8febdafb',
            'X-Paymennt-Api-Secret:mer_c241e43b7d39b8279983258e25791806ea9d03194222632d0dc8c538d597cfc2'
        ];
        $body = [
            "requestId" => $data['id'],
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
        $url = "https://api.test.paymennt.com/mer/v2.0/checkout/link";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, TRUE);
        if ($res["success"]) {
            return $res['result']['redirectUrl'];
        } else {
            return $res['error'];
        }
    }
}
