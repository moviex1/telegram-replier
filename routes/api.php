<?php

use App\Telegram\Application\Http\Controllers\Messages\GetMessagesController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', GetMessagesController::class);
