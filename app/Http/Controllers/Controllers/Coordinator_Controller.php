<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Models\User_Coordinator;
use App\User;

class Coordinator_Controller extends Controller
{
    //
    public function coordinator_profile($id){
        $user = User::find($id);
        return response()->json($user->coordinator);
    }
    
}
