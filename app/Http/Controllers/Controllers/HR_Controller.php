<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\User_HR;
use App\Models\User_Company;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\Company_interns;


class HR_Controller extends Controller
{
    //
    public function hr_profile($id){
        $user = User::find($id);
        return response()->json($user->hr);
    }
    

     public function hr_application_list($id){
        $applications = Application::where('company_id',$id)->get();
        foreach ($applications as $application) {
            $application->student;
            $application->logs;
            $application->advertisement;
            
        }
        return response()->json($applications);
    }
}
