<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalOrganic = Transaction::where('user_id', $user->id)
            ->where('waste_type', 'organic')
            ->sum('amount');

        $totalAnorganic = Transaction::where('user_id', $user->id)
            ->where('waste_type', 'anorganic')
            ->sum('amount');

        $estimatedRupiah = $user->points_balance * 1;

        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $formattedDate = $date->format('Y-m-d');
            $displayDate = $date->format('D'); 

            $sum = Transaction::where('user_id', $user->id)
                ->whereDate('created_at', $formattedDate)
                ->sum('amount');

            $chartLabels[] = $displayDate;
            $chartData[] = $sum;
        }

        $connectedDevice = session('connected_device');

        return view('dashboard', compact(
            'user', 
            'transactions', 
            'connectedDevice', 
            'totalOrganic', 
            'totalAnorganic', 
            'estimatedRupiah',
            'chartLabels',
            'chartData'
        ));
    }

    public function connect($deviceCode)
    {
        if (!$deviceCode) {
            return redirect()->route('dashboard');
        }

        $user = Auth::user();

        Cache::put('device_user_' . $deviceCode, $user->id, 1200); 

        session(['connected_device' => $deviceCode]);

        return redirect()->route('setor.index');
    }

    public function setor()
    {
        $deviceCode = session('connected_device');
        $user = Auth::user();

        if (!$deviceCode) {
            return view('scan'); 
        }

        return view('setor', compact('deviceCode', 'user'));
    }

    public function triggerDevice(Request $request)
    {
        $request->validate([
            'type' => 'required|in:organic,anorganic'
        ]);

        $deviceCode = session('connected_device');

        if (!$deviceCode) {
            return response()->json(['status' => 'error', 'message' => 'Device not connected'], 400);
        }

        $command = $request->type === 'organic' ? 'OPEN_ORGANIC' : 'OPEN_ANORGANIC';
        
        Cache::put('device_command_' . $deviceCode, $command, 30);

        return response()->json([
            'status' => 'success', 
            'message' => 'Perintah dikirim ke alat.'
        ]);
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

        $user = Auth::user();

        $points = 0;
        if ($request->waste_type == 'anorganic') {
            $points = $request->amount * 40;
        } else {
            $points = floor($request->amount / 10);
        }

        Transaction::create([
            'user_id' => $user->id,
            'device_code' => 'SIMULASI-DARURAT',
            'waste_type' => $request->waste_type,
            'amount' => $request->amount,
            'points_earned' => $points,
        ]);

        $user->points_balance += $points;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Simulasi berhasil!');
    }
    public function handleQrScan($deviceCode)
    {
        session(['connected_device' => $deviceCode]);

        Cache::put('device_user_' . $deviceCode, Auth::id(), 1200);

        return redirect()->route('setor.index');
    }
    public function checkLatestTransaction($deviceCode)
    {
        $user = Auth::user();

        $transaction = Transaction::where('user_id', $user->id)
            ->where('device_code', $deviceCode)
            ->where('created_at', '>=', Carbon::now()->subSeconds(10)) 
            ->latest()
            ->first();

        if ($transaction) {
            return response()->json([
                'status' => 'found',
                'points' => $transaction->points_earned,
                'amount' => $transaction->amount,
                'type'   => $transaction->waste_type
            ]);
        }

        return response()->json(['status' => 'waiting']);
    }
}