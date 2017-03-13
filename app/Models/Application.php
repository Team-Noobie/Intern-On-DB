<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $table = 'tbl_application';
    protected $primaryKey = 'ID';


    public function advertisement(){
        return $this->belongsTo('App\Models\Advertisement','ads_id','ID');
    }

    public function company(){
        return $this->hasOne('App\Models\User_Company','user_ID','company_id');
    }
    public function student(){
         return $this->hasOne('App\Models\User_Student','User_ID','student_id');
    }

}
