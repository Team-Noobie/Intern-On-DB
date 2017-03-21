<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Company_interns extends Model
{
    //
    protected $table = 'tbl_company_interns';
    protected $primaryKey = 'id';

    public function company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function student(){
        return $this->belongsTo('App\Models\User_Student','student_id','user_ID');
    }

}
