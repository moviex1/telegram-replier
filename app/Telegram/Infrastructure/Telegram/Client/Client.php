<?php

declare(strict_types=1);

namespace App\Telegram\Infrastructure\Telegram\Client;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private const string TELEGRAM_BOT_API_URL = 'https://api.telegram.org/bot';

    public function __construct(
        private string $botToken,
        private int $connectTimeout,
        private int $requestTimeout,
    )
    {
    }

    /**
     * @throws InvalidTelegramResponse
     * @throws ConnectionException
     */
    public function send(string $method, array $data = []): array
    {
        $response = Http::connectTimeout($this->connectTimeout)
            ->timeout($this->requestTimeout)
            ->post(
                url: $this->getUrl($method),
                data: $data
            )->json();

        if (is_array($response) === false) {
            throw new InvalidTelegramResponse;
        }

        return $response;
    }

    private function getUrl(string $method): string
    {
        return self::TELEGRAM_BOT_API_URL . $this->botToken . "/$method";
    }
}
