<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //usergroup relation
    public function usergroup(){
        return $this->belongsTo('App\Usergroup','user_type_id');
    }


    //userplan
    public function user_plan(){
        return $this->hasMany('App\UserPlan','user_id');
    }
}
