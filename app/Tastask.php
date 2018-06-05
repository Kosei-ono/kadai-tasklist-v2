<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tastask extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
