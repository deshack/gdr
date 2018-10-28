<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chat\Message
 *
 * @property int         $id
 * @property int         $channel_id
 * @property int         $user_id
 * @property string      $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Message whereCreatedAt( $value )
 * @method static Builder|Message whereId( $value )
 * @method static Builder|Message whereMessage( $value )
 * @method static Builder|Message whereUpdatedAt( $value )
 * @method static Builder|Message whereChannelId( $value )
 * @method static Builder|Message whereUserId( $value )
 *
 * @mixin \Eloquent
 */
class Message extends Model {
    protected $table = 'chat_messages';

    protected $fillable = [
        'channel_id',
        'user_id',
        'message',
    ];

    public function channel() {
        return $this->belongsTo( Channel::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }
}
