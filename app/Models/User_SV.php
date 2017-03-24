<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_SV extends Model
{
    //
    protected $table = 'tbl_user_sv';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';
}
