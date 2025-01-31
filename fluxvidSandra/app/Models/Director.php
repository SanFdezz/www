<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    function movies(){
        return $this->hasMany(Movie::class);
    }
}
