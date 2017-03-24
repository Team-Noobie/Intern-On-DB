<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\User_Administrator;
use App\Models\User_Company;
use App\Models\User_Coordinator;

use App\User;


class Administrator_Module_Controller extends Controller
{
    //   

    public function create_company_account(Request $request){
    		$user = new User;
    		$user->username = $request->company_username;
    		$user->password = bcrypt("changeme");
    		$user->type = "company";
    		$user->save();

            $company = new User_Company;
            $company->user_ID = $user->id;
            $company->company_name = $request->company_name;
            $company->save();

            return response()->json($request);
    }

     public function create_coordinator_account(Request $request){
    		$user = new User;
    		$user->username = $request->coordinator_username;
    		$user->password = bcrypt("changeme");
    		$user->type = "coordinator";
    		$user->save();

            $coordinator = new User_Coordinator;
            $coordinator->user_ID = $user->id;
            $coordinator->coordinator_firstname = $request->coordinator_firstname;
            $coordinator->coordinator_lastname = $request->coordinator_lastname;
            $coordinator->save();

            return response()->json($request);
    }

    public function company_accounts_list(){
        $company = User_Company::all();
        return response()->json($company);
    }
    
    public function coordinator_accounts_list(){
        $coordinator = User_Coordinator::all();
        return response()->json($coordinator);
    }


}
