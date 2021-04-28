<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class GeoLocationResource extends JsonResource
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
            'type' => 'GeoLocation',
            'id' => $this->id,
            'attributes' => [
                'latitud' => $this->latitud,
                'longitud' => $this->longitud,
                'addr_id' => $this->addr_id
            ],
            'links' => [
                'self' => 'route()'
            ]
        ];
    }
}
