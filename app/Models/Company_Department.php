<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_Department extends Model
{
    //
    protected $table = 'tbl_company_departments';
    protected $primaryKey = 'id';

    public function Company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function Employees(){
        return $this->hasMany('App\Models\User_SV','department_id','id');
    }

    
}
