<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Application;
use App\Models\Application_Log;


class Application_Log_Controller extends Controller
{
    //

    public function view_application(Request $request,$id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "Viewed";
        $application->update();

        $app_log = new Application_Log; 
        $app_log->application_ID = $id;
        $app_log->status = "Viewed";
        $app_log->save();        
        return response()->json($application);
    }


    public function reject_application(Request $request,$id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "Failed";
        $application->update();

        $app_log = new Application_Log; 
        $app_log->application_ID = $id;
        $app_log->status = "Failed";
        $app_log->remarks = $request->remarks;
        $app_log->save();        

        return response()->json($application);
    }

    public function interview_result(Request $request,$id){
        $app_log = Application_Log::find($id);
        $app_log->remarks = $request->remarks;
        $app_log->status = "Done";
        $app_log->update();
        return response()->json($app_log);
    }


    public function hire_applicant(Request $request,$id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "For Hiring";
        $application->update();

        $app_log = new Application_Log; 
        $app_log->application_ID = $id;
        $app_log->status = "For Hiring";
        $app_log->remarks = $request->remarks;
        $app_log->save();        

        return response()->json($application);
    }

    public function check_set_interview($id){
        $app_log = Application_Log::where('application_ID',$id)->where('status','Set')->count();
        if($app_log >= 1)
            return response()->json(true);
        if($app_log == 0)
            return response()->json(false);
    }


    public function application($id){
        $application = Application::find($id);
        $application->logs;
        return response()->json($application);
    }

}
