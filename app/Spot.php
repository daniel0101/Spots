<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    //
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
}
