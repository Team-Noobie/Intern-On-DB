<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User;
use App\Models\User_SV;
use App\Models\User_Company;
use App\Models\Company_Interns;
use App\Models\Reports;
use App\Models\Grades;

class SV_Controller extends Controller
{
    //
    public function sv_profile($id){
        $user = User::find($id);
        $user->sv->company;
        return response()->json($user->sv);
    }

    public function sv_intern_list($id){
        $interns = Company_interns::where('department_id',$id)->get();
        foreach ($interns as $intern) {
            $intern->Student;
            $intern->Reports;
            $intern->Timecard;
            foreach($intern->Reports as $Report){
                $Report->Supervisor;
            }
        }
        return response()->json($interns);        
    }

    public function sv_report(Request $request,$id){
        $report = new Reports;
        $report->company_intern_id = $id;
        $report->report = $request->report;
        $report->sv_id = $request->sv_id;
        $report->report_date = $request->date;
        $report->save();
        return response()->json($report);        
    }
    public function grade_intern(Request $request){
        $grade = new Grades;
        $grade->sv_id = $request->sv_id;
        $grade->student_id = $request->student_id;
        $grade->grade = $request->grade;
        $grade->punctuality = $request->punctuality;
        $grade->competence = $request->competence;
        $grade->effectiveness = $request->effectiveness;
        $grade->cooperation = $request->cooperation;
        $grade->pr = $request->pr;
        $grade->comment = $request->comment;
        $grade->save();
    }

     public function edit_sv_profile(Request $request,$id){
        $sv = User_SV::find($id);
        $sv->sv_firstname= $request->sv_firstname;
        $sv->sv_lastname= $request->sv_lastname;
        $sv->sv_email= $request->sv_email;
        $sv->sv_contact_no= $request->sv_contact_no;
        $sv->sv_address= $request->sv_address;
       
        $sv->update();
        return response()->json($sv);    
    }
}
