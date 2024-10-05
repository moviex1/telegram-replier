<?php

declare(strict_types=1);

namespace App\Telegram\Domain\DTO\Telegram;

final readonly class SendMessageDTO
{
    public function __construct(
        public string $text,
        public int $chatId,
        public ?int $replyToId = null,
    ) {}
}
