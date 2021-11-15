<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public function events() {
        
        return $this->belongsTo('App\Models\User', 'foreign_key');
    }
   
}
