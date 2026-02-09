<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $totalPoints = Transaction::where('user_id', $user->id)->sum('points_earned');
        $totalWeight = Transaction::where('user_id', $user->id)->sum('amount');

        return view('history', compact('transactions', 'totalPoints', 'totalWeight'));
    }
}