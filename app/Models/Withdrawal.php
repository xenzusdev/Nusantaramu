<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'account_number',
        'amount',
        'status',
    ];

    /**
     * Relasi ke User pemilik withdrawal ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}