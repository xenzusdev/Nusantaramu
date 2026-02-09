<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points_balance', // Tambah ini
        'wallet_balance', // Tambah ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}