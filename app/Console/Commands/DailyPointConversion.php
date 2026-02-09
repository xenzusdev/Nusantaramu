<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DailyPointConversion extends Command
{
    protected $signature = 'app:convert-points';
    protected $description = 'Convert user points to wallet balance daily';

    public function handle()
    {
        User::where('points_balance', '>', 0)->chunk(100, function ($users) {
            foreach ($users as $user) {
                DB::transaction(function () use ($user) {
                    $rupiah = $user->points_balance * 1; 
                    
                    $user->wallet_balance += $rupiah;
                    $user->points_balance = 0; 
                    $user->save();
                });
            }
        });
        
        $this->info('Daily conversion completed.');
    }
}