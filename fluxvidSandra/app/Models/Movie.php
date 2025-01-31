<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    function director(){
        return $this->belongsTo(Director::class);
    }
}
