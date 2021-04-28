<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducerResource extends JsonResource
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
            'type' => 'Producer',
            'id' => $this->id,
            'attributes' => [
                'sede_ppal' => $this->sede_ppal
            ],
            'links' => [
                'self' => 'route()'
            ]
        ];
    }
}
