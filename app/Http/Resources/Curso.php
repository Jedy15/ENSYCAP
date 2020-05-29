<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Curso extends JsonResource
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
            'curso'         => $this->curso,
            'dirigido'      => $this->dirigido,
            'duracion'      => $this->duracion.' hrs',
            'credito'       => $this->credito,
            'created'       => $this->created_at->diffForHumans(),
            'created_at'    => $this->created_at->format('d-m-Y'),
            'updated_at'    => $this->updated_at->format('d-m-Y'),
            'usuario'       => $this->User->name,
            'modalidad'     => $this->Modalidad->modalidad,

        ];
    }
}
