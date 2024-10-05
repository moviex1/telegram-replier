<?php

use App\Telegram\Domain\Exceptions\RecordNotFound;
use App\Telegram\Infrastructure\Telegram\Client\InvalidTelegramResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware) {})
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (RecordNotFound $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (InvalidTelegramResponse $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
