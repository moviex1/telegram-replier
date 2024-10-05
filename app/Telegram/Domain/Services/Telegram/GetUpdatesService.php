<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Services\Telegram;

use App\Telegram\Domain\DTO\Telegram\UpdateDTO;
use App\Telegram\Domain\Interfaces\UpdateTrackerInterface;
use App\Telegram\Infrastructure\Telegram\Client\Client as TelegramClient;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;

final readonly class GetUpdatesService
{
    public function __construct(
        private TelegramClient $telegramClient,
        private UpdateTrackerInterface $updateTracker,
    ) {}

    /**
     * @throws InvalidTelegramResponse
     */
    public function __invoke(bool $updateLastId = true): array
    {
        $updateId = $this->updateTracker->getLastUpdateId();

        $response = $this->telegramClient->send('getUpdates', [
            'offset' => $updateId,
            'limit' => config('telegram.limit-updates'),
            'allowed_updates' => ['message'],
        ]);

        $updates = $this->mapUpdates($response['result']);

        if ($updateLastId === true) {
            /** @var false|UpdateDTO $lastUpdate */
            $lastUpdate = last($updates);

            if ($lastUpdate !== false) {
                $this->updateTracker->setLastUpdateId($lastUpdate->updateId + 1);
            }
        }

        return $updates;
    }

    /**
     * @param array<array-key, mixed> $result
     * @return UpdateDTO[]
     */
    private function mapUpdates(array $result): array
    {
        $updates = [];
        foreach ($result as $update) {
            $updates[] = new UpdateDTO(
                updateId: $update['update_id'],
                messageId: $update['message']['message_id'],
                chatId: $update['message']['chat']['id'],
                text: $update['message']['text'],
            );
        }

        return $updates;
    }
}
