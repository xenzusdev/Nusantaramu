<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $history = Donation::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('donation', compact('user', 'history'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'institution' => 'required|string', 
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->wallet_balance < $request->amount) {
            return back()->withErrors(['amount' => 'Saldo tidak mencukupi untuk sedekah ini.']);
        }

        try {
            DB::beginTransaction();

            Donation::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'institution' => $request->institution,
                'prayer' => $request->prayer ?? null,
                'status' => 'completed', 
            ]);

            $user->wallet_balance -= $request->amount;
            $user->save();

            DB::commit();
            return redirect()->route('donation.index')->with('success', 'Terima kasih! Sedekah berhasil disalurkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses donasi.');
        }
    }
}