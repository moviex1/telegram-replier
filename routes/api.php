<?php

use App\Telegram\Application\Http\Controllers\Messages\GetMessagesController;
use App\Telegram\Application\Http\Controllers\Messages\ReplyToMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', GetMessagesController::class);
Route::post('/messages/{messageId}/reply', ReplyToMessageController::class);
