<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\User_Company;
use App\Models\Company_interns;
use App\User;

class Company_Controller extends Controller
{
    //
    public function company_profile($id){
        $user = User::find($id);
        return response()->json($user->company);
    }
    
     public function company_advertisement_list($id){
        $ads = Advertisement::where('company_id',$id)->get();
        return response()->json($ads);
    }

    public function create_advertisement(Request $request){
            $ad = new Advertisement;
            $ad->company_id = $request->id;
            $ad->ads_title = $request->ad_title;
            // $ad->ads_requirement = $request->ad_requirements;
            $ad->ads_job_description = $request->ad_description;
            $ad->ads_work_location = 'location';
            $ad->ads_contact = $request->ad_contacts;
            $ad->ads_visibility = "Hide";
            $ad->save();
            return response()->json($request);
    }

    public function view_advertisement($id){
        $advertisement = Advertisement::find($id);
        return response()->json($advertisement);    
    }

    public function set_interview(Request $request,$id){
        $application = Application::find($id);
        $application->status = "On-Process";
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

    public function get_schedules($id){
        $schedules = DB::table('tbl_application')
            ->join('tbl_application_log', 'tbl_application.id', '=', 'tbl_application_log.application_ID')
            ->join('tbl_user_student', 'tbl_user_student.user_ID', '=', 'tbl_application.student_id')
            ->join('tbl_advertisement', 'tbl_advertisement.id', '=', 'tbl_application.ads_id')            
            ->select('tbl_application_log.id','tbl_user_student.student_firstname','tbl_user_student.student_lastname',
            'tbl_application_log.reason','tbl_application_log.interview_date','tbl_application_log.interview_time'
            ,'tbl_advertisement.ads_title')
            ->where('tbl_application.company_id',$id)
            ->where('tbl_application_log.status','Set')
            ->get();
        return response()->json($schedules);
    }

    public function hire_applicant($id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "For Hiring";
        $application->update();     

        $intern = new Company_interns;
        $intern->student_id = $application->student_id;
        $intern->company_id = $application->company_id;
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

    public function intern_list($id){
        $company = User_Company::find($id);
        foreach ($company->Interns as $intern) {
            $intern->student;
        }
        return response()->json($company->Interns);
    }

    public function interview_result(Request $request,$id){
        $app_log = Application_Log::find($id);
        $app_log->remarks = $request->remarks;
        $app_log->status = "Done";
        $app_log->update();
        return response()->json($app_log);  
    }

    public function company_application_list($id){
        $applications = Application::where('company_id',$id)->get();
        foreach ($applications as $application) {
            $application->student;
            $application->logs;
            $application->advertisement;
            
        }
        return response()->json($applications);

    }
    
}
