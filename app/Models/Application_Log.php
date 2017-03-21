<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application_Log extends Model
{
    //
    protected $table = 'tbl_application_log';
    protected $primaryKey = 'id';

    public function application(){
        //  return $this->belongsTo('App\Models\Application','id','application_id');
        return $this->belongsTo('App\Models\Application','application_ID','id');

    }

}
