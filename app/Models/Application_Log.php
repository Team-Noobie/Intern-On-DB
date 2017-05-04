<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application_Log extends Model
{
    //
    protected $table = 'tbl_application_log';
    protected $primaryKey = 'id';

    public function application(){
        return $this->belongsTo('App\Models\Application','application_id','id');
    }
    public function interviewer(){
        return $this->hasOne('App\Models\User_HR','user_ID','hr_id');
    }

}
