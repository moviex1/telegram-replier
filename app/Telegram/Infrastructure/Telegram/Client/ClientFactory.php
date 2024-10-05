<?php

declare(strict_types=1);

namespace App\Telegram\Infrastructure\Telegram\Client;

final readonly class ClientFactory
{
    public function __construct(
        private int $connectTimeout = 15,
        private int $requestTimeout = 10,
    )
    {
    }

    public function create(string $token): Client
    {
        return new Client($token, $this->connectTimeout, $this->requestTimeout);
    }
}
