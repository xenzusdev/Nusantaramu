<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;
use App\Notifications\WithdrawalStatus;

class AdminController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->orderByRaw("FIELD(status, 'pending', 'completed', 'rejected')")->latest()->get();
        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($request->status == 'rejected' && $withdrawal->status == 'pending') {
            $user = User::find($withdrawal->user_id);
            $user->wallet_balance += $withdrawal->amount;
            $user->save();
        }

        $withdrawal->status = $request->status;
        $withdrawal->save();

        $user = User::find($withdrawal->user_id);
        $user->notify(new WithdrawalStatus($request->status, $withdrawal->amount));
        
        return back()->with('success', 'Status berhasil diperbarui!');
    }
}