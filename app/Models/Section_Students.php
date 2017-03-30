<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section_Students extends Model
{
    //
    protected $table = 'tbl_section_students';
    protected $primaryKey = 'id';

    public function student(){
         return $this->hasOne('App\Models\User_Student','user_ID','student_id');
    }

}
