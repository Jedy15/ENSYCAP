<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignado extends Model
{
    protected $fillable = [
        'CLUES','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clue()
    {
        return $this->belongsTo('App\Clue', 'CLUES', 'CLUES');
    }
}
