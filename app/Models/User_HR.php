<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_HR extends Model
{
    //
    
    protected $table = 'tbl_user_hr';
    protected $hidden = ['id'];
    protected $primaryKey = 'user_ID';

    public function interviews(){
        return $this->hasMany('App\Models\Application_Log','hr_id','user_ID');
    }

     public function hr_advertisement_list($id){
        $ads = Advertisement::where('company_id',$id)->get();
        return response()->json($ads);
    }

    public function hr_view_advertisement($id){
        $advertisement = Advertisement::find($id);
        return response()->json($advertisement);    
    }

    public function hr_dvertisement_application_list($id){
        $ads = Advertisement::where('company_id',$id)->get();
        foreach ($ads as $ad) {
            $ad->count = $ad->Application->count();
        }
        return response()->json($ads);
    }

    public function hr_advertisement_applicant_list(Request $request,$id){

        $applications = Application::where('ads_ID',$id)->where('status',$request->type)->get();       
        foreach ($applications as $application) {
            $application->student;
        }

        return response()->json($applications); 
    }

    public function hr_view_application($id){
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

    public function hr_set_interview(Request $request,$id){
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

    public function hr_get_schedules($id){
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

    public function hr_hire_applicant($id){
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
    public function hr_reject_application($id){
        $application = Application::find($id);
        $application->student;
        $application->advertisement;
        $application->status = "Failed";
        $application->update();

        return response()->json($application);
    }

    public function hr_intern_list($id){
        $company = User_Company::find($id);
        foreach ($company->Interns as $intern) {
            $intern->student;
        }
        return response()->json($company->Interns);
    }

    public function hr_interview_result(Request $request,$id){
        $app_log = Application_Log::find($id);
        $app_log->remarks = $request->remarks;
        $app_log->status = "Done";
        $app_log->update();
        return response()->json($app_log);
        
    }


}
