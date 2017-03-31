<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    //

    protected $table = 'tbl_reports';
    protected $primaryKey = 'id';




    public function Supervisor(){
        return $this->hasOne('App\Models\User_SV','user_ID','sv_id');
    }

}
