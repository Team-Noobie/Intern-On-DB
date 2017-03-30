<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_SV extends Model
{
    //
    protected $table = 'tbl_user_sv';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';


    public function Company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function Department(){
        return $this->belongsTo('App\Models\Company_Department','department_id','id');
    }
}
