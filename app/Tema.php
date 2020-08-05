<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    protected $fillable = [
        'event_id', 'curso_id', 'ponente_id',
    ];

    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function ponente()
    {
        return $this->belongsTo(Ponente::class);
    }

    public $timestamps = false; //sin fechas de creación y actualización
}
