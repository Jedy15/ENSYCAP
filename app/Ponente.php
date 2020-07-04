<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ponente extends Model
{
    protected $fillable = [
        'ponente', 'email', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use SoftDeletes;
}
