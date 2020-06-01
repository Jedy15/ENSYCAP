<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    protected $fillable = [
        'ponente', 'email', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
