<?php

namespace App\Http\Controllers\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User_Company;
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
}
