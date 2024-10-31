<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\CorrectRoleForEmail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function showAdminLinkRequestForm()
    {
        return view('auth.passwords.admin-email');
    }
    protected function credentials(Request $request)
    {
        return $request->only(['email', 'role']);
    }
    protected function validateEmail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'role' => 'required', new CorrectRoleForEmail($request->email)
            ]
        );
    }

    use SendsPasswordResetEmails;
}
