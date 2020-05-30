<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Asistencia extends JsonResource
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
            'id'         => $this->id,
            'asistencia' => $this->asistencia,
            'acredita'   => $this->acredita,
            'constancia' => $this->constancia,
            'libro'      => $this->libro,
            'evento'     => $this->Event,
            'personal'   => $this->Personal,
        ];
    }
}
