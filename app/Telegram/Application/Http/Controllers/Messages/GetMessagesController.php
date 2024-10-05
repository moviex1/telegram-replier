<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Controllers\Messages;

use App\Telegram\Application\Http\Controllers\Controller;

final class GetMessagesController extends Controller
{
    public function __invoke(): string
    {
        return 'asdf';
    }
}
