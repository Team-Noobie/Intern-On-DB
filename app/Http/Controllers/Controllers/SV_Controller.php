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

    public function sv_intern_list($id){
        $interns = Company_interns::where('department_id',$id)->get();
        foreach ($interns as $intern) {
            $intern->Student;
        }
        return response()->json($interns);        
    }
}
