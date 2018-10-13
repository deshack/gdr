<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chat\Channel
 *
 * @mixin \Eloquent
 *
 * @property int         $id
 * @property string      $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Channel whereCreatedAt( $value )
 * @method static Builder|Channel whereId( $value )
 * @method static Builder|Channel whereName( $value )
 * @method static Builder|Channel whereUpdatedAt( $value )
 */
class Channel extends Model {
    protected $table = 'chat_channels';

    protected $fillable = [
        'name',
    ];
}
