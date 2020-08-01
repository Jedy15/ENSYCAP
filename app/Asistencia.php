<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'asistencia','acredita','constancia','libro','event_id','personal_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'personal_id', 'IdPersonal');
    }

    public $timestamps = false; //sin fechas de creación y actualización
}
