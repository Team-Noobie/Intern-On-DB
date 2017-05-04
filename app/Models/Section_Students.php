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
    public function coordinator(){
         return $this->hasOne('App\Models\User_Coordinator','user_ID','coordinator_id');
    }

    public function Intern(){
         return $this->hasOne('App\Models\Company_interns','student_id','student_id');
    }

}
