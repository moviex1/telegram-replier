<?php

declare(strict_types=1);

namespace App\Telegram\Domain\DTO\Telegram;

final readonly class UpdateDTO
{
    public function __construct(
        public int $updateId,
        public string $messageId,
        public string $chatId,
    ){}
}
