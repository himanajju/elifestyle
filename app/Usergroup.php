<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    public function users(){
   		return $this->hasMany('App\User','user_type_id');
   	}
}
