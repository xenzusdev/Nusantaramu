<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua request, yang pending di paling atas
        $withdrawals = Withdrawal::with('user')->orderByRaw("FIELD(status, 'pending', 'completed', 'rejected')")->latest()->get();
        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($request->status == 'rejected' && $withdrawal->status == 'pending') {
            // Refund saldo user kalau ditolak
            $user = User::find($withdrawal->user_id);
            $user->wallet_balance += $withdrawal->amount;
            $user->save();
        }

        $withdrawal->status = $request->status;
        $withdrawal->save();

        return back()->with('success', 'Status berhasil diperbarui!');
    }
}