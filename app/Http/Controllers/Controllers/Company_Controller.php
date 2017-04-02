<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\Company_Interns;
use App\Models\Company_Department;
use App\User;
use App\Models\User_Company;
use App\Models\User_HR;
use App\Models\User_SV;



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
            $ad->ads_work_location = $request->ad_location;
            $ad->ads_contact = $request->ad_contacts;
            $ad->ads_visibility = "Hide";
            $ad->save();
            return response()->json($request);
    }
    public function view_advertisement($id){
        $advertisement = Advertisement::find($id);
        return response()->json($advertisement);    
    }
    public function intern_list($id){
        $company = User_Company::find($id);
        foreach ($company->Interns as $intern) {
            $intern->student;
            $intern->department;
        }
        return response()->json($company->Interns);
    }
    public function department_list($id){
        $departments = Company_Department::where('company_id',$id)->get();
        foreach ($departments as $department) {
            $department->Employees;
        }        
        return response()->json($departments);
    }
    public function create_department(Request $request,$id){
        $department = new Company_Department;
        $department->company_id = $id;
        $department->department_name = $request->department_name;
        $department->save();
        return response()->json($department);
    }
    public function hr_list($id){
        $hr_list = User_HR::where('company_id',$id)->get();
        return response()->json($hr_list);
    }
    public function sv_list($id){
        $sv_list = User_SV::where('company_id',$id)->get();
        foreach ($sv_list as $list) {
            $list->department;
        }
        return response()->json($sv_list);
    }
    public function create_hr(Request $request,$id){
        $user = new User;
        $user->username = $request->hr_username;
        $user->password = bcrypt("changeme");
        $user->type = "hr";
        $user->save();

        $hr = new User_HR;
        $hr->user_ID = $user->id;
        $hr->company_id = $id;        
        $hr->hr_firstname = $request->hr_firstname;
        $hr->hr_lastname = $request->hr_lastname;
        $hr->hr_email = $request->hr_email;
        $hr->save();

    }
    public function create_sv(Request $request,$id){
        $user = new User;
        $user->username = $request->sv_username;
        $user->password = bcrypt("changeme");
        $user->type = "sv";
        $user->save();

        $sv = new User_sv;
        $sv->user_ID = $user->id;
        $sv->company_id = $id;
        $sv->department_id = $request->department_id;      
        $sv->sv_firstname = $request->sv_firstname;
        $sv->sv_lastname = $request->sv_lastname;
        $sv->sv_email = $request->sv_email;
        $sv->save();

        return response()->json($sv);
        
    }
    
}
