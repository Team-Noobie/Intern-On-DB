<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\User_Student;
use App\User;

class Student_Controller extends Controller
{
    //
    public function student_profile($id){
        $user = User::find($id);
        return response()->json($user->student);
    }

    public function search_advertisement($id){

        $advertisements = Advertisement::whereDoesntHave('Application', function ($query) use ($id) {
            $query->where('student_id', $id);
        })->get();
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
}
