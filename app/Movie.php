<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    public function show()
    {
        return $this->hasMany(Show::class);
    }
}
