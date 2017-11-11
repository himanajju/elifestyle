<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMonth extends Model
{
    
    //userplan
    public function user_plan(){
        return $this->hasMany('App\UserPlan','subscription_months_id');
    }
}
