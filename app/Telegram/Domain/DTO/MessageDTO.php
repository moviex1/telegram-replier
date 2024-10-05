<?php

declare(strict_types=1);

namespace App\Telegram\Domain\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'Message')]
final readonly class MessageDTO
{
    public function __construct(
        #[OA\Property(title: 'messageId', format: 'integer', example: 1)]
        public int $messageId,
        #[OA\Property(title: 'chatId', format: 'integer', example: 1)]
        public int $chatId,
        #[OA\Property(title: 'text', format: 'string')]
        public string $text,
        #[OA\Property(title: 'id', format: 'integer', default: 1)]
        public ?int $id = null,
    ) {}
}
