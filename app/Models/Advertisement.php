<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    //
    protected $table = 'tbl_advertisement';
    protected $primaryKey = 'ID';

    public function Company(){
        return $this->belongsTo('App\Models\User_Company','company_id','user_ID');
    }

    public function Application(){
        return $this->hasMany('App\Models\Application','ads_id','ID');
    }
}
