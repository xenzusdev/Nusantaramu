<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->take(5)->get();
        $totalOrganic = Transaction::where('user_id', $user->id)
            ->where('waste_type', 'organic')
            ->sum('amount');
        $totalAnorganic = Transaction::where('user_id', $user->id)
            ->where('waste_type', 'anorganic')
            ->sum('amount');
        $connectedDevice = session('connected_device');

        return view('dashboard', compact('user', 'transactions', 'connectedDevice', 'totalOrganic', 'totalAnorganic'));
    }

    public function connect(Request $request)
    {
        $deviceCode = $request->query('device');
        if (!$deviceCode) {
            return redirect()->route('dashboard');
        }

        session(['connected_device' => $deviceCode]);
        return redirect()->route('dashboard');
    }

    public function simulation()
    {
        return view('simulation');
    }

    public function storeSimulation(Request $request)
    {
        $request->validate([
            'waste_type' => 'required|in:organic,anorganic',
            'amount' => 'required|numeric|min:0.1',
        ]);

        $points = 0;

        if ($request->waste_type == 'anorganic') {
            $points = $request->amount * 50;
        } else {
            $points = $request->amount * 500;
        }

        $money = $points * 1;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        Transaction::create([
            'user_id' => $user->id,
            'device_code' => 'SIMULATOR-WEB',
            'waste_type' => $request->waste_type,
            'amount' => $request->amount,
            'points_earned' => $points,
        ]);

        $user->points_balance += $points;
        $user->wallet_balance += $money;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Sampah berhasil disetor! Poin bertambah.');
    }
}