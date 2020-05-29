<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
     protected $fillable = [
        'curso', 'duracion', 'credito', 'dirigido', 'user_id', 'modalidad_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }
    
}
