<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppDetail extends Model
{
    public function apps(){
        return $this->belongsTo('App\App','app_id');
    }

}
