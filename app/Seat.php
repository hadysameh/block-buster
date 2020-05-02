<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    //
    public function show()
    {
    	return $this->belongsTo(Show::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
