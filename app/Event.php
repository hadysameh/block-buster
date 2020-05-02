<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public function show()
    {
        # code...
        return $this->hasMany(Show::class);
    }
}
