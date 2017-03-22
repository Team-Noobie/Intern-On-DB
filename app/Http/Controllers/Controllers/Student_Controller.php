<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\User_Student;
use App\User;

class Student_Controller extends Controller
{
    //
    public function student_profile($id){
        $user = User::find($id);
        return response()->json($user->student);
    }

    public function search_advertisement(){
        $advertisements = Advertisement::all();
        foreach ($advertisements as $advertisement) {
            $advertisement->Company;
        }
        return response()->json($advertisements);    
    }

    public function view_advertisement($id){
        $advertisement = Advertisement::find($id);
        $advertisement->Company;
        return response()->json($advertisement);    
    }


    public function application_check(Request $request){
        $advertisement = DB::table('tbl_advertisement')
            ->join('tbl_application', 'tbl_advertisement.ID', '=', 'tbl_application.ads_id')
            ->join('tbl_user_student', 'tbl_user_student.user_ID', '=', 'tbl_application.student_id')
            ->select('*')
            ->where('tbl_application.student_id',$request->student_id)
            ->where('tbl_application.ads_id',$request->ad_id)
            ->get();

        if($advertisement->count() == 1){
            $advertisement->hasApplied= true;
        }
        if($advertisement->count() == 0){
            $advertisement->hasApplied =  false;
        }
        return response()->json($advertisement->hasApplied);       
    }

    public function apply(Request $request){
            $app = new Application;
            $app->ads_id= $request->ad_id;
            $app->company_id= $request->company_id;
            $app->student_id= $request->student_id;
            $app->status = 'New';
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
    
}
