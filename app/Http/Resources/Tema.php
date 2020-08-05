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
            'id'            => $this->id,
            'event_id'      => $this->event_id,
            'curso_id'      => $this->curso_id,
            'ponente_id'    => $this->ponente_id,
            //optional para saltar los valores null o vacios
            'evento'        => optional($this->Event)->title,
            'curso'         => optional($this->Curso)->curso,
            'ponente'       => optional($this->Ponente)->ponente,


        ];
    }
}
