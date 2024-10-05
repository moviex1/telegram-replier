<?php

declare(strict_types=1);

namespace App\Telegram\Application\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'ReplyToMessageRequest',
    content: new OA\JsonContent(
        required: ['text'],
        properties: [
            new OA\Property(property: 'text', type: 'string', example: 'message text'),
        ],
        type: 'object'
    )
)]
final class ReplyToMessageRequest extends FormRequest
{
    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
        ];
    }
}
