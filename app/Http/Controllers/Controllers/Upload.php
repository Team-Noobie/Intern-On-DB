<?php

namespace App\Http\Controllers\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User_Company;
use App\Models\User_Student;
use App\Models\User_Coordinator;
use App\Models\User_HR;
use App\Models\User_SV;
use Storage;


class Upload extends Controller
{
    //

    public function upload_pic(Request $request){
        $Company = User_Company::find($request->id);
        if($Company->company_logo == ""){
            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Company->company_logo = $request->file('file')->getClientOriginalName();
            $Company->update();
        }else{
            Storage::delete('pictures/'.$request->id.'/'.$Company->company_logo);

            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Company->company_logo = $request->file('file')->getClientOriginalName();
            $Company->update();
        }
        

        return response()->json($Company);        
    }

    public function upload_student_pic(Request $request){
        $Student = User_Student::find($request->id);
        if($Student->Student_pic == ""){
            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Student->student_pic = $request->file('file')->getClientOriginalName();
            $Student->update();
        }else{
            Storage::delete('pictures/'.$request->id.'/'.$Student->student_pic);

            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Student->student_pic = $request->file('file')->getClientOriginalName();
            $Student->update();
        }
        

        return response()->json($Student);        
    }
     public function upload_coordinator_pic(Request $request){
        $Coordinator = User_Coordinator::find($request->id);
        if($Coordinator->Coordinator_pic == ""){
            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Coordinator->coordinator_pic = $request->file('file')->getClientOriginalName();
            $Coordinator->update();
        }else{
            Storage::delete('pictures/'.$request->id.'/'.$Coordinator->coordinator_pic);

            Storage::put('pictures/'.$request->id.'/'.$request->file('file')->getClientOriginalName(),
                file_get_contents($request->file('file')->getRealPath())
            );
            $Coordinator->coordinator_pic = $request->file('file')->getClientOriginalName();
            $Coordinator->update();
        }
        

        return response()->json($Coordinator);        
    }


}
