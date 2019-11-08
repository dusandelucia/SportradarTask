<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class authors extends Model
{
    public function books(){
        $this->hasMany(books::class);
    }
}
