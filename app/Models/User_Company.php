<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User_Company extends Model
{
    //
    protected $table = 'tbl_user_company';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';

    public function Advertisements(){
        return $this->hasMany('App\Models\Advertisement','company_id','user_ID');
    }

    public function Interns(){
        return $this->hasMany('App\Models\Company_interns','company_id','user_ID');
    }

}
