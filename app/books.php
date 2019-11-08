<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    public function author(){
        $this->belongsTo(authors::class);
    }
}
