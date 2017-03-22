<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\User_Coordinator;
use App\Models\User_Student;
use App\Models\Section;
use App\Models\Section_Students;
use App\User;

class Coordinator_Controller extends Controller
{
    //
    public function coordinator_profile($id){
        $user = User::find($id);
        return response()->json($user->coordinator);
    }

    public function create_student_section(Request $request){
    		$section= new Section;
    		$section->section_code = $request->section_code;
    		$section->save();

            return response()->json($request);
    }
    
    public function section_list(){
        $section = Section::all();
        return response()->json($section);
    }

    public function enroll_student(Request $request){
        
    		$user = new User;
    		$user->username = $request->student_username;
    		$user->password = bcrypt("changeme");
    		$user->type = "student";
    		$user->save();

            $student = new User_Student;
            $student->user_ID = $user->id;
            $student->student_firstname = $request->student_firstname;
            $student->student_lastname = $request->student_lastname;
            $student->save();

            $section = new Section_Students;
            $section->student_id = $user->id;
            $section->coordinator_id = $request->coordinator_id;
            $section->section_id = $request->section_id;
            $section->save();
            
            return response()->json($request);
    }

    
}
