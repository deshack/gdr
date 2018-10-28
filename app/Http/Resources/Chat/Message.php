<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Message extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request ) {
        return [
            'id'      => $this->id,
            'user'    => new User( $this->user ),
            'message' => $this->message,
            'date'    => optional( $this->created_at )->format( 'd/m/Y H:i' ),
        ];
    }
}
