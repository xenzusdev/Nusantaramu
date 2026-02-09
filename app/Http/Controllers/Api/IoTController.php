<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\User;

class IoTController extends Controller
{
    public function getCommand(Request $request)
    {
        $deviceCode = $request->query('device_code');
        
        if (!$deviceCode) {
            return response()->json(['command' => null]);
        }

        $command = Cache::pull('device_command_' . $deviceCode);

        return response()->json([
            'command' => $command 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'device_code' => 'required|string',
            'waste_type' => 'required|in:organic,anorganic',
            'amount' => 'required|numeric|min:0.1|max:50'
        ]);

        $userId = Cache::get('device_user_' . $request->device_code);

        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'No user connected'], 404);
        }

        $points = ($request->waste_type === 'anorganic') 
            ? floor($request->amount * 50) 
            : floor($request->amount * 10);

        try {
            DB::beginTransaction();

            $user = User::where('id', $userId)->lockForUpdate()->first();

            if (!$user) {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }

            Transaction::create([
                'user_id' => $user->id,
                'device_code' => $request->device_code,
                'waste_type' => $request->waste_type,
                'amount' => $request->amount,
                'points_earned' => $points,
            ]);

            $user->points_balance += $points;
            
            // Konversi Poin ke Saldo (Opsional: 1 Poin = Rp 1)
            $user->wallet_balance += $points;
            
            $user->save();

            DB::commit();

            return response()->json(['status' => 'success', 'earned' => $points]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Server Error'], 500);
        }
    }
}