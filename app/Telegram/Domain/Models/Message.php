<?php

declare(strict_types=1);

namespace App\Telegram\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $message_id
 * @property int $chat_id
 * @property string $text
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereText($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $table = 'messages';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'message_id',
        'chat_id',
        'text',
    ];
}
