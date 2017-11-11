<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //userplan
    public function user_plan(){
        return $this->hasMany('App\UserPlan','plan_id');
    }

}
