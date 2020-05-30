<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $fillable = [
        'modalidad','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
