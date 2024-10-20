<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    protected function authenticated(Request $request, $user)
    {
        $role = $request->role;

        if (in_array($role, ['user', 'advertiser', 'owner'])) {
            if (!in_array($user->role, ['moderator', 'admin'])) {
                $user['role'] = $role;
                $user->update();
            }
        }

    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/roles';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
