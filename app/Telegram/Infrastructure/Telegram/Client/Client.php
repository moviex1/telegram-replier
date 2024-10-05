<?php

declare(strict_types=1);

namespace App\Telegram\Infrastructure\Telegram\Client;

use Illuminate\Support\Facades\Http;

final readonly class Client
{
    /**
     * @throws InvalidTelegramResponse
     */
    public function send(string $method, array $data = []): array
    {
        $response = Http::post(
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
        return 'https://api.telegram.org/bot'.config('telegram.bot-token')."/$method";
    }
}
