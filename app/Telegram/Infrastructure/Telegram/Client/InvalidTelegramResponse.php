<?php

declare(strict_types=1);

namespace App\Telegram\Infrastructure\Telegram\Client;

final class InvalidTelegramResponse extends \Exception
{
    protected $message = 'Invalid Telegram response';
}
