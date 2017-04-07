<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Student extends Model
{
    //
    protected $table = 'tbl_user_student';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';

    public function Application(){
        return $this->hasMany('App\Models\Application','student_id','user_ID');
    }

    public function User(){
        return $this->belongsTo('App\User','user_ID','id');
    }

    public function Section(){
        return $this->hasOne('App\Models\Section_Students','student_id','user_ID');
    }

    public function Intern(){
        return $this->hasOne('App\Models\Company_interns','student_id','user_ID');
    }

}
