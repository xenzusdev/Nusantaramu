<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($withdrawal->status != 'pending') {
            return back()->with('error', 'Transaksi sudah diproses sebelumnya.');
        }

        $withdrawal->update(['status' => 'completed']);

        return back()->with('success', 'Penarikan disetujui. Dana segera dikirim.');
    }

    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status != 'pending') {
            return back()->with('error', 'Transaksi sudah diproses sebelumnya.');
        }

        try {
            DB::beginTransaction();

            $withdrawal->update(['status' => 'rejected']);

            $user = User::findOrFail($withdrawal->user_id);
            $user->wallet_balance += $withdrawal->amount;
            $user->save();

            DB::commit();
            return back()->with('success', 'Penarikan ditolak. Saldo dikembalikan ke user.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }
}