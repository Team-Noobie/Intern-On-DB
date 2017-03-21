<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Advertisement extends Model
{
    //
    protected $table = 'tbl_advertisement';
    protected $primaryKey = 'id';

    public function Company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function Application(){
        return $this->hasMany('App\Models\Application','ads_id','id');
    }

    // public function checkApplication($id){
    //     $query = Application::where('student_id',$id)->get();
    // }
}
