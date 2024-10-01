<?php

namespace App\Http\Controllers\Moderator;


use App\Http\Controllers\Controller;
use App\Models\BalanceApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BalanceModeratorController extends Controller
{

    public function index(Request $request): View
    {
        $applications = BalanceApplication::query()
            ->join('users', 'users.id', '=', 'balance_applications.user_id');
        $data = $request->all();
        if (isset($data['status']) and $data['status'] != 'all') {
            $applications->where('balance_applications.status', $data['status']);
        }
        if (isset($data['role']) and $data['role'] != 'all') {
            $applications->where('users.role', $data['role']);
        }
        if (isset($data['email']) and $data['email'] == true) {
            $applications->where('users.email', 'LIKE', "%{$data['email']}%");
        }
        if (isset($data['phone']) and $data['phone'] == true) {
            $applications->where('users.phone', 'LIKE', "%{$data['phone']}%");
        }
        if (isset($data['name']) and $data['name'] == true) {
            $applications->where('users.name', 'LIKE', "%{$data['name']}%");
        }
        if (isset($data['last_name']) and $data['last_name'] == true) {
            $applications->where('users.last_name', 'LIKE', "%{$data['last_name']}%");
        }
        $applications = $applications->select('balance_applications.*')->paginate(10);
        return view('moderator.balance.index', compact('applications'));
    }

    public function update(BalanceApplication $application, Request $request): RedirectResponse
    {
        $user = User::where('id', $application->user_id)->first();
        if ($request->status == 'approved') {
            if ($application->type == 'replenish') {
                $user->balance = $user->balance + $application->amount;
                $user->update();
            }
            $application->update(['status' => 'approved']);
        } else {
            if ($application->type == 'withdraw') {
                $user->balance = $user->balance + $application->amount;
                $user->update();
            }
            $application->update(['status' => 'cancelled']);
        }
        deleteNotification('balance');
        return back();
    }
}
