<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Jobs;

use App\Telegram\Domain\DTO\Telegram\SendMessageDTO;
use App\Telegram\Domain\Services\Telegram\SendMessageService;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class SendMessage implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly SendMessageDTO $sendMessageDTO)
    {
        $this->queue = 'send_message';
    }

    /**
     * @throws InvalidTelegramResponse
     */
    public function handle(SendMessageService $sendMessageService): void
    {
        $sendMessageService->__invoke($this->sendMessageDTO);
    }
}
