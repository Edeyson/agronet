<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'type' => 'Event',
            'id' => $this->id,
            'attributes' => [
                'producer_id' => $this->producer_id,
                'addr_id' => $this->addr_id,
                'fecha' => $this->fecha,
                'hora' => $this->hora,
                'duracion' => $this->duracion,
                'state' => $this->state,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'Addr'=> [
                    'data' => $this->addr?[
                        'type' => 'addr',
                        'id' => $this->addr->id
                    ]:[]
                ]
            ],
            'links' => [
                'self' => 'route()'
            ]
        ];
    }
}
