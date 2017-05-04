<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'tbl_sections';
    protected $primaryKey = 'id';



    public function Students(){
        return $this->hasMany('App\Models\Section_Students','Section_id','id');
    }
}
