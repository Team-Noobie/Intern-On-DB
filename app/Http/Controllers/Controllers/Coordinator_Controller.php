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

    public function create_student_section(Request $request,$id){
    		$section= new Section;
    		$section->section_code = $request->section_code;
    		$section->coordinator_id = $id;
            $section->save();

            return response()->json($request);
    }
    
    public function section_list($id){
        $sections = Section::where('coordinator_id',$id)->get();
        foreach ($sections as $section) {
            $section->Students;
            foreach ($section->Students as $student) {
                $student->student;
            }                
        }
        return response()->json($sections);
    }

    public function view_section_students($id){
        $sectionStudents = Section_Students::where('section_id',$id)->get();
        foreach ($sectionStudents as $sectionStudent) {
            $sectionStudent->Students;
        }
        return response()->json($sectionStudents);
    }


    public function enroll_student(Request $request,$id){
        
    		$user = new User;
    		$user->username = $request->student_username;
    		$user->password = bcrypt("changeme");
    		$user->type = "student";
    		$user->save();

            $student = new User_Student;
            $student->user_ID = $user->id;
            $student->student_firstname = $request->student_firstname;
            $student->student_lastname = $request->student_lastname;
            $student->student_email = $request->student_email;
            $student->student_contact_no = $request->student_contact_no;
            $student->save();

            $section = new Section_Students;
            $section->student_id = $user->id;
            $section->coordinator_id = $id;
            $section->section_id = $request->section_id;
            $section->save();
            
            return response()->json($request);
    }

    
}
