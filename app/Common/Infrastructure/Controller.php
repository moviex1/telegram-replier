<?php

declare(strict_types=1);

namespace App\Common\Infrastructure;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    /** @param array<array-key, mixed> $data */
    public function success(array $data = [], int $status = Response::HTTP_OK, ?string $message = null): JsonResponse
    {
        return new JsonResponse(
            data: [
                'success' => true,
                'data' => $data,
                'message' => $message,
            ],
            status: $status
        );
    }

    /** @param array<array-key, mixed> $data */
    public function fail(array $data = [], int $status = Response::HTTP_BAD_REQUEST, ?string $message = null): JsonResponse
    {
        return new JsonResponse(
            data: [
                'success' => false,
                'data' => $data,
                'message' => $message,
            ],
            status: $status
        );
    }
}
