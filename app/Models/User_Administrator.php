<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User_Administrator extends Model
{
    //
        // protected $table = 'tbl_user_admin';
        protected $hidden = ['id'];
        protected $primaryKey = 'user_ID';


}
