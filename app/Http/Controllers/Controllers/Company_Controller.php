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

    public function advertisement_application_list($id){
        $ads = Advertisement::where('company_id',$id)->get();
        foreach ($ads as $ad) {
            $ad->count = $ad->Application->count();
        }
        return response()->json($ads);
    }

    public function advertisement_applicant_list(Request $request,$id){

        $applications = Application::where('ads_ID',$id)->where('status',$request->type)->get();       
        foreach ($applications as $application) {
            $application->student;
        }

        return response()->json($applications); 
    }

    public function view_application($id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->logs;
        if($application->status == "New"){
            $application->status = "Pending";
            $application->update();
        }
        return response()->json($application);         
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
            ->select('*')
            ->where('tbl_application.company_id',$id)
            ->where('tbl_application_log.status','Set')
            ->get();

        return response()->json($schedules);

        
    }
}
