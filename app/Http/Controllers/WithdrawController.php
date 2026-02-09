<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Withdrawal;
use App\Models\User;

class WithdrawController extends Controller
{
    public function index()
    {
        return view('withdraw');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'account_number' => 'required|numeric|digits_between:8,15',
            'amount' => 'required|numeric|min:10000|max:1000000',
        ]);

        $user = Auth::user();

        try {
            DB::beginTransaction();

            // KUNCI ROW USER: Mencegah race condition (double withdraw)
            // Sistem lain harus antre sampai blok ini selesai
            $lockedUser = User::where('id', $user->id)->lockForUpdate()->first();

            // 1. Cek Saldo Cukup?
            if ($lockedUser->wallet_balance < $request->amount) {
                DB::rollBack();
                return back()->withErrors(['amount' => 'Saldo tidak mencukupi.']);
            }

            // 2. Cek Apakah Ada Transaksi Pending? (Anti-Spam)
            $pendingExists = Withdrawal::where('user_id', $lockedUser->id)
                ->where('status', 'pending')
                ->exists();

            if ($pendingExists) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Selesaikan penarikan sebelumnya dulu.']);
            }

            // 3. Potong Saldo DULUAN (Penting: Potong sebelum simpan request)
            $lockedUser->wallet_balance -= $request->amount;
            $lockedUser->save();

            // 4. Buat Record Penarikan
            Withdrawal::create([
                'user_id' => $lockedUser->id,
                'payment_method' => $request->payment_method,
                'account_number' => $request->account_number,
                'amount' => $request->amount,
                'status' => 'pending'
            ]);

            DB::commit();

            return redirect()->route('withdraw.index')->with('success', 'Permintaan penarikan berhasil diajukan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem. Coba lagi.']);
        }
    }
}