<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $table = 'tbl_application';
    protected $primaryKey = 'id';


    public function advertisement(){
        return $this->belongsTo('App\Models\Advertisement','ads_id','id');
    }

    public function company(){
        return $this->hasOne('App\Models\User_Company','user_ID','company_id');
    }

    public function student(){
         return $this->hasOne('App\Models\User_Student','user_ID','student_id');
    }

    public function logs(){
         return $this->hasMany('App\Models\Application_Log','application_id','id');
    }
    

}
