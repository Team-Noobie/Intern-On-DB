<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\Advertisement;
use App\Models\Application;
use App\Models\Application_Log;
use App\Models\Company_Interns;
use App\Models\Company_Department;
use App\User;
use App\Models\User_Company;
use App\Models\User_HR;
use App\Models\User_SV;



class Company_Controller extends Controller
{
    
    // public function search_advertisement($id){
    //     $advertisements = Advertisement::whereDoesntHave('Application', function ($query) use ($id) {
    //         $query->where('student_id', $id);
    //     })->where('ads_visibility','Show')->get();
    //     foreach ($advertisements as $advertisement) {
    //         $advertisement->company;
    //     }
    //     return response()->json($advertisements);    
    // }

    // public function view_advertisement($id){
    //     $advertisement = Advertisement::find($id);
    //     $advertisement->company;
    //     return response()->json($advertisement);    
    }
}