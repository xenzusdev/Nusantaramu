<?php

use Illuminate\Foundation\Inspire;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspire::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:convert-points')->dailyAt('00:00');