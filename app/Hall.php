<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    //
    public function show()
    {
        # code...
        return $this->hasMany(Show::class);
    }
}
