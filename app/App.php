<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    //
 	public function appDetails(){
   		return $this->hasMany('App\AppDetail','app_id');
   	}   
}
