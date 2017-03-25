<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_HR extends Model
{
    //
    
    protected $table = 'tbl_user_hr';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';

    public function interviews(){
        return $this->hasMany('App\Models\Application_Log','hr_id','user_ID');
    }
}
