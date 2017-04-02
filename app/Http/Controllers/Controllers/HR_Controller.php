<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\Company_Interns;
use App\Models\Company_Department;
use App\User;
use App\Models\User_Company;
use App\Models\User_HR;
use App\Models\User_SV;


class HR_Controller extends Controller
{
    //
    public function hr_profile($id){
        $user = User::find($id);
        return response()->json($user->hr);
    }

    public function set_interview(Request $request,$id){
        $application = Application::find($id);
        $application->update();

        $app_log = new Application_Log; 
        $app_log->application_ID = $id;
        $app_log->status = "Set";
        $app_log->interview_date = $request->interview_date;
        $app_log->interview_time = $request->interview_time;
        $app_log->reason = $request->reason;        
        $app_log->save();
        return response()->json($app_log);
    }

    public function interview_result(Request $request,$id){
        $app_log = Application_Log::find($id);
        $app_log->remarks = $request->remarks;
        $app_log->status = "Done";
        $app_log->update();
        return response()->json($app_log); 
    }

    public function get_schedules($id){
        $schedules = Application_Log::where('status','Set')->whereHas('application', function ($query) use ($id) {
                        $query->where('company_id', $id);
                    })->get();
        foreach ($schedules as $log) {
            $log->application;
            $log->application->student;
            $log->application->advertisement;
        }

        return response()->json($schedules);
    }

    public function intern_list($id){
        $company = User_Company::find($id);
        foreach ($company->Interns as $intern) {
            $intern->student;
            $intern->department;
        }
        return response()->json($company->Interns);
    }

    public function company_application_list($id){
        $applications = Application::where('company_id',$id)->where('status','Pending')->get();
        foreach ($applications as $application) {
            $application->student;
            $application->logs;
            $application->advertisement;
            
        }
        return response()->json($applications);
    }

    public function hire_applicant(Request $request,$id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "Hired";
        $application->update();     

        $intern = new Company_Interns;
        $intern->student_id = $application->student_id;
        $intern->company_id = $application->company_id;
        $intern->department_id = $request->department_id;
        $intern->status = 'Active';
        $intern->save();     

        $intern->company;
        $intern->student;
        return response()->json($intern);
    }

    public function reject_application($id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "Failed";
        $application->update();

        return response()->json($application);
    }
}
