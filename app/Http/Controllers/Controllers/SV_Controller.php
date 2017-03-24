<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User;
use App\Models\User_HR;
use App\Models\User_Company;
use App\Models\Company_interns;

class SV_Controller extends Controller
{
    //
    public function sv_profile($id){
        $user = User::find($id);
        return response()->json($user->sv);
    }
}
