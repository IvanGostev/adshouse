<?php

use App\Console\Commands\CheckTariffCommand;
use App\Console\Commands\RefreshRoomsCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command(RefreshRoomsCommand::class)->days(3);
Schedule::command(CheckTariffCommand::class)->hourly();
