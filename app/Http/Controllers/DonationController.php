<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $history = Donation::where('user_id', $user->id)->latest()->get();
        return view('donation', compact('user', 'history'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'prayer' => 'nullable|string|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->wallet_balance < $request->amount) {
            return back()->withErrors(['amount' => 'Saldo kebaikan tidak mencukupi.']);
        }

        // 1. Kurangi Saldo User
        $user->wallet_balance -= $request->amount;
        $user->save();

        // 2. Catat Donasi
        Donation::create([
            'user_id' => $user->id,
            'institution' => $request->institution,
            'amount' => $request->amount,
            'prayer' => $request->prayer,
        ]);

        return redirect()->route('donation.index')->with('success', 'Alhamdulillah! Sedekah berhasil disalurkan.');
    }
}