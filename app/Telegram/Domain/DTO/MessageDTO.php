<?php

declare(strict_types=1);

namespace App\Telegram\Domain\DTO;

final readonly class MessageDTO
{
    public function __construct(
        public int $messageId,
        public int $chatId,
        public string $text,
        public ?int $id = null,
    )
    {
    }
}
