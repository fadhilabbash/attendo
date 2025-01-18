<?php

use App\Console\Commands\SyncDeviceUsers;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();


Artisan::command('sync:device-users', function () {
    $this->call(SyncDeviceUsers::class);
})->purpose('Sync users between ZKTeco device and MySQL database')->everyMinute();
