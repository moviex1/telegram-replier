<?php

use App\Telegram\Domain\Schedule\ProcessTelegramUpdates;
use Illuminate\Support\Facades\Schedule;

Schedule::call(ProcessTelegramUpdates::class)->everySecond();
