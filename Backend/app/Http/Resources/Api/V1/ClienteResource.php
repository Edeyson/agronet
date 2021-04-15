<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'Cliente',
            'id' => $this->id,
            'attributes' => [
                'direccion' => $this->direccion
            ],
            'links' => [
                'self' => route('user.profile')
            ]
        ];
    }
}
