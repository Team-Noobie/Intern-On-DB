<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application_Log extends Model
{
    //
    protected $table = 'tbl_application_log';
    protected $primaryKey = 'ID';

    public function application(){
         return $this->hasOne('App\Models\Application','ID','application_id');
    }

    public function check_set(){
         return $this->where('Status','Set');        
    }
}
