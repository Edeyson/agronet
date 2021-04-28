<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AddrResource extends JsonResource
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
            'type' => 'addr',
            'id' => $this->id,
            'attributes' => [
                'registered_user_id' => $this->registered_user_id,
                'country' => $this->country,
                'province' => $this->province,
                'city' => $this->city,
                'street' => $this->street,
                'location' => $this->location,
                'etiqueta' => $this->etiqueta,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'geoLocation'=> [
                    'data' => $this->geoLocation?[
                        'type' => 'GeoLocation',
                        'id' => $this->geoLocation->id
                    ]:[]
                ]
            ],
            'links' => [
                'self' => 'route()'
            ]
        ];
    }
}
