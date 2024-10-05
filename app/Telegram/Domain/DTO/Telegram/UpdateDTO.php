<?php

declare(strict_types=1);

namespace App\Telegram\Domain\DTO\Telegram;

final readonly class UpdateDTO
{
    public function __construct(
        public int $updateId,
        public int $messageId,
        public int $chatId,
        public string $text,
    ) {}
}
