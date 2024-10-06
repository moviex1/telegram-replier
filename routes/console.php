<?php

use App\Telegram\Application\Console\Schedule\ProcessTelegramUpdates;
use Illuminate\Support\Facades\Schedule;

Schedule::call(ProcessTelegramUpdates::class)->everySecond();
