<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    //
    public function hall()
    {
        # code...
        return $this->belongsTo(Hall::class);
    }
    public function event()
    {
        # code...
        return $this->belongsTo(Event::class);
    }

    public function movie()
    {
        # code...
        return $this->belongsTo(Movie::class);
    }
}
