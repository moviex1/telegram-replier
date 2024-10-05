<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Jobs;

use App\Telegram\Domain\DTO\MessageDTO;
use App\Telegram\Domain\DTO\Telegram\UpdateDTO;
use App\Telegram\Domain\Services\Message\StoreMessageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class ProcessUpdate implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly UpdateDTO $updateDTO)
    {
        $this->queue = 'process_updates';
    }

    public function handle(StoreMessageService $storeMessageService): void
    {
        $storeMessageService->__invoke(new MessageDTO(
            messageId: $this->updateDTO->messageId,
            chatId: $this->updateDTO->chatId,
            text: $this->updateDTO->text
        ));
    }
}
