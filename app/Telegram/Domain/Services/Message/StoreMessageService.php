<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Message;

use App\Telegram\Domain\DTO\Message\MessageDTO;
use App\Telegram\Domain\Mappers\MessageMapper;

final readonly class StoreMessageService
{
    public function __construct(
        private MessageMapper $messageMapper,
    ) {}

    public function __invoke(MessageDTO $messageDTO): void
    {
        $message = $this->messageMapper->toModel($messageDTO);

        $message->save();
    }
}
