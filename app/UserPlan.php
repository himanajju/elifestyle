<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
        //usergroup relation
    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

    public function plans(){
        return $this->belongsTo('App\Plan','plan_id');
    }

    public function subscriptions(){
        return $this->belongsTo('App\SubscriptionMonth','subscription_months_id');
    }


}
