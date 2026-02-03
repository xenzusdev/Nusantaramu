<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WithdrawalStatus extends Notification
{
    use Queueable;

    public $status;
    public $amount;

    public function __construct($status, $amount)
    {
        $this->status = $status;
        $this->amount = $amount;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke database
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->status == 'completed' ? 'Penarikan Berhasil!' : 'Penarikan Ditolak',
            'message' => $this->status == 'completed' 
                ? 'Saldo Rp ' . number_format($this->amount) . ' telah dikirim ke akun Anda.' 
                : 'Maaf, pengajuan penarikan Rp ' . number_format($this->amount) . ' ditolak.',
            'type' => $this->status == 'completed' ? 'success' : 'danger',
            'link' => route('withdraw.index')
        ];
    }
}