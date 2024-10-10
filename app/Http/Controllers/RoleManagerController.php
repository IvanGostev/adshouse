<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleManagerController extends Controller
{
    public function change() {
        $user = auth()->user();
        if ($user->role == 'owner') {
            $user->role = 'advertiser';
        } else {
            $user->role = 'owner';
        }
        $user->update();
        return redirect('/');
    }
}
