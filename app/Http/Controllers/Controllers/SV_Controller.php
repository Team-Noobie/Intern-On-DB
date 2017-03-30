<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User;
use App\Models\User_HR;
use App\Models\User_Company;
use App\Models\Company_Interns;
use App\Models\Reports;


class SV_Controller extends Controller
{
    //
    public function sv_profile($id){
        $user = User::find($id);
        return response()->json($user->sv);
    }

    public function sv_intern_list($id){
        $interns = Company_interns::where('department_id',$id)->get();
        foreach ($interns as $intern) {
            $intern->Student;
            $intern->Reports;
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
        $report->save();
        return response()->json($report);        
        
    }
}
