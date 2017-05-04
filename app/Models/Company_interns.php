<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_Interns extends Model
{
    //
    protected $table = 'tbl_company_interns';
    protected $primaryKey = 'id';

    public function Company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function Student(){
         return $this->belongsTo('App\Models\User_Student','student_id','user_ID');
    }

    public function Department(){
        return $this->belongsTo('App\Models\Company_Department','department_id','id');
    }

    public function Reports(){
        return $this->hasMany('App\Models\Reports','company_intern_id','id');
    }

    public function Timecard(){
        return $this->hasMany('App\Models\Timecards','company_intern_id','id');
    }

}
