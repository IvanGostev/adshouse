<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Mail\PasswordMail;
use App\Models\BalanceApplication;
use App\Models\User;
use App\Models\UserTariff;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserModeratorController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query();
        $data = $request->all();

        if (isset($data['role']) and $data['role'] != 'all') {
            $users->where('role', $data['role']);
        }
        if (isset($data['email']) and $data['email'] == true) {
            $users->where('email', 'LIKE', "%{$data['email']}%");
        }
        if (isset($data['phone']) and $data['phone'] == true) {
            $users->where('phone', 'LIKE', "%{$data['phone']}%");
        }
        if (isset($data['name']) and $data['name'] == true) {
            $users->where('name', 'LIKE', "%{$data['name']}%");
        }
        if (isset($data['last_name']) and $data['last_name'] == true) {
            $users->where('last_name', 'LIKE', "%{$data['last_name']}%");
        }
        $users = $users->latest()->paginate(10);
        return view('moderator.user.index', compact('users'));
    }

    function history(User $user)
    {
        $transactions = BalanceApplication::where('user_id', $user->id)->get();
        return view('moderator.user.history', compact('transactions'));
    }

    function tariffs(User $user)
    {
        $items = UserTariff::where('user_id', $user->id)->get();
        return view('moderator.user.tariffs', compact('items'));
    }
    function houses(User $user)
    {
        $items = UserTariff::where('user_id', $user->id)->get();
        return view('moderator.user.tariffs', compact('items'));
    }
    function create()
    {
        return view('moderator.user.create');
    }

    function store(Request $request)
    {
        $data = $request->all();
        $password = Str::random(10);
        $data['role'] = 'moderator';
        $data['password'] = Hash::make($password);
        User::create($data);
        Mail::to($request->email)->send(new PasswordMail($password));
        return redirect()->route('moderator.user.index');
    }

    function destroy(User $user) {
        $user->delete();
        return back();
    }

}
