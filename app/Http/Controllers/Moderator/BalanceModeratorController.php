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

    public function index(): View
    {
        $applications = BalanceApplication::where('status', 'moderation')->paginate(10);
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
        return back();
    }
}
