<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
            $ad->ads_requirement = 'trial';
            
            // $ad->ads_responsibility = $request->ad_responsibilities;
            $ad->ads_responsibility = 'trial';
            
            
            $ad->ads_contact = $request->ad_contacts;
            $ad->ads_visibility = "Not-Visible";
            $ad->save();
            return response()->json($request);
    }

    public function view_advertisement($id){
        $advertisement = Advertisement::find($id);
        $advertisement->ads_requirement = $advertisement->ads_requirement;
        $advertisement->ads_responsibility = $advertisement->ads_responsibility;
        $advertisement->ads_contact = $advertisement->ads_contact;
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
        if($application->status == "New"){
            $application->status = "Pending";
            $application->update();
        }
        return response()->json($application);         
    }
}
