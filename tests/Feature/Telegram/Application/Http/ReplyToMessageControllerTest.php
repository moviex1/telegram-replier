<?php

declare(strict_types=1);

namespace Feature\Telegram\Application\Http;

use App\Telegram\Domain\Jobs\SendMessage;
use App\Telegram\Domain\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ReplyToMessageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessful(): void
    {
        $message = $this->createMessage();

        $queue = Queue::fake();
        $queue->assertNothingPushed();

        $response = $this->post(
            uri: "/api/messages/$message->id/reply",
            data: [
                'text' => 'test',
            ],
        );

        $response->assertSuccessful();
        $response->assertExactJson([
            'success' => true,
            'data' => [],
            'message' => null,
        ]);

        $queue->assertPushedOn('send_messages', SendMessage::class);
    }

    public function testUnprocessableEntity(): void
    {
        $response = $this->post(
            uri: '/api/messages/3/reply',
            headers: [
                'Accept' => 'application/json',
            ]
        );

        $response->assertUnprocessable();
    }

    public function testNotFound(): void
    {
        $response = $this->post(
            uri: '/api/messages/3/reply',
            data: [
                'text' => 'test',
            ],
        );

        $response->assertNotFound();
        self::assertFalse($response->json('success'));
    }

    private function createMessage(): Message
    {
        $message = new Message;

        $message->message_id = 1;
        $message->chat_id = 1;
        $message->text = 'test';

        $message->save();

        return $message;
    }
}
