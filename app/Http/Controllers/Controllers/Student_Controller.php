<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\User_Student;
use App\Models\Company_interns;
use App\User;

class Student_Controller extends Controller
{
    //
    public function student_profile($id){
        $user = User::find($id);
        $user->student;
        $user->student->section;
        $user->student->section->coordinator;
        
        
        return response()->json($user->student);
    }

    public function search_advertisement($id){
        $advertisements = Advertisement::whereDoesntHave('Application', function ($query) use ($id) {
            $query->where('student_id', $id);
        })->where('ads_visibility','Show')->get();
        foreach ($advertisements as $advertisement) {
            $advertisement->company;
        }
        return response()->json($advertisements);    
    }

    public function view_advertisement($id){
        $advertisement = Advertisement::find($id);
        $advertisement->Company;
        return response()->json($advertisement);    
    }

    public function apply(Request $request){
            $app = new Application;
            $app->ads_id= $request->ad_id;
            $app->company_id= $request->company_id;
            $app->student_id= $request->student_id;
            $app->status = 'Pending';
            $app->save();
            return response()->json($app);
    }

    public function application_list($id){
        $apps = Application::where('student_id',$id)->get();
        foreach ($apps as $app) {
            $app->company;
            $app->advertisement;
        }
        return response()->json($apps);
    }

    public function upload_resume(Request $request){
        $student = User_Student::find($request->id);
        if($student->resume == ""){
            Storage::put('resume/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $student->resume = $request->file('file')->getClientOriginalName();
            $student->update();
        }else{
            Storage::delete('resume/'.$request->id.'/'.$student->resume);

            Storage::put('resume/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $student->resume = $request->file('file')->getClientOriginalName();
            $student->update();
        }
        

        return response()->json($student);        
    }




    
    public function student_schedule($id){
        $schedules = Application_Log::where('status','Set')->whereHas('application', function ($query) use ($id) {
                        $query->where('student_id', $id);
                    })->get();
        foreach ($schedules as $log) {
            $log->application;
            $log->application->company;
            $log->application->advertisement;
        }
        return response()->json($schedules);
    }

    public function student_timecard($id){
        $interns = Company_interns::where('student_id',$id)->get();
        foreach ($interns as $intern) {
            $intern->Timecard;
        }
        return response()->json($interns);
    
    }
    public function edit_student_profile(Request $request,$id){
        $student = User_Student::find($id);
        $student->student_firstname= $request->student_firstname;
        $student->student_lastname= $request->student_lastname;
        $student->student_contact_no= $request->student_contact_no;
        $student->student_email= $request->student_email;
        $student->student_address= $request->student_address;
        $student->student_birthday= $request->student_birthday;
        $student->student_gender= $request->student_gender;
                
        $student->update();
        return response()->json($student);    
    }
}
