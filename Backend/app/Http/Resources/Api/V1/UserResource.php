<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'User',
            'id' => $this->id,
            'attributes' => [
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'email' => $this->email,
                'departamento' => $this->departamento,
                'ciudad' => $this->ciudad,
                'telefono' => $this->telefono,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'links' => [
                'self' => 'route()'
            ]
        ];
    }
}
