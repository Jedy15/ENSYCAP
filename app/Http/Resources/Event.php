<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
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
            'title'         => $this->title,
            'place'         => $this->place,
            'start'         => $this->start,
            'end'           => $this->end,
            'color'         => $this->color,
            'description'   => $this->description,
            'allDay'        => $this->end ? FALSE : TRUE,
            'created'       => $this->created_at->diffForHumans(),
            'created_at'    => $this->created_at->format('d-m-Y'),
            'updated_at'    => $this->updated_at->format('d-m-Y'),
            'usuario'       => $this->User->name,
            'sede'          => $this->Clue->NOMBRE_UNIDAD,
        ];
    }
}
