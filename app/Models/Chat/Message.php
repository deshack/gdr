<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chat\Message
 *
 * @property int         $id
 * @property string      $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Message whereCreatedAt( $value )
 * @method static Builder|Message whereId( $value )
 * @method static Builder|Message whereMessage( $value )
 * @method static Builder|Message whereUpdatedAt( $value )
 *
 * @mixin \Eloquent
 */
class Message extends Model {
    protected $table = 'chat_messages';

    protected $fillable = [
        'message',
    ];
}
