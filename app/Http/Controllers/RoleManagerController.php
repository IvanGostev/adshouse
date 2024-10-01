<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleManagerController extends Controller
{
    public function change() {
        $user = auth()->user();
        if ($user->role == 'user') {
            $user->role = 'advertiser';
        } else {
            $user->role = 'user';
        }
        $user->update();
        return redirect('/');
    }
}
