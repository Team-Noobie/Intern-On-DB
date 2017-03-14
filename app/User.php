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
    protected $table = 'tbl_user';
    protected $fillable = [ 
        'email', 'password','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function student(){
        return $this->hasOne('App\Models\User_Student','user_ID','id');
    }

    public function company(){
        return $this->hasOne('App\Models\User_Company','user_ID','id');
    }

    public function coordinator(){
        return $this->hasOne('App\Models\User_Coordinator','user_ID','id');
    }
}
