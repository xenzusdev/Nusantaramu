<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;
use App\Models\User;

class WithdrawController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $history = Withdrawal::where('user_id', $user->id)->latest()->get();
        return view('withdraw', compact('user', 'history'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:GOPAY,DANA,OVO,SHOPEEPAY',
            'account_number' => 'required|numeric',
            'amount' => 'required|numeric|min:10000',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->wallet_balance < $request->amount) {
            return back()->withErrors(['amount' => 'Saldo tidak mencukupi untuk penarikan ini.']);
        }

        Withdrawal::create([
            'user_id' => $user->id,
            'payment_method' => $request->payment_method,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
        ]);

        $user->wallet_balance -= $request->amount;
        $user->save();

        return redirect()->route('withdraw.index')->with('success', 'Permintaan penarikan berhasil dikirim!');
    }
}