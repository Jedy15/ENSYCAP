<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'start', 'end', 'description', 'CLUES', 'user_id',
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
