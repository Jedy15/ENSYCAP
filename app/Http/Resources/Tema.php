<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Tema extends JsonResource
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
            'id'        => $this->id,
            'evento'    => $this->event_id,
            'curso'     => $this->Curso->curso,
            'ponente'   => $this->Ponente->ponente,
        ];
    }
}
