<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\User;
use App\Models\User_Student;

class User_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = $request->type;

        $user->save();

        if($request->type == 'student'){
            $student = new User_Student;
            $student->student_name = $request->lastname. ", ".$request->firstname;
            $student->user_ID = $user->id;
            $student->save();
        }


        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        
        if($user->type == "student"){
            $student = DB::table('tbl_user')
                ->join('tbl_user_student','tbl_user.id','=','tbl_user_student.user_ID')
                ->select('tbl_user_student.student_name','tbl_user.email')
                ->where('tbl_user.id',$id)
                ->get();
                return response()->json($student);
        }
        
        if($user->type == "company"){
            $company = DB::table('tbl_user')
                ->join('tbl_user_company','tbl_user.id','=','tbl_user_company.user_ID')
                ->select('tbl_user_company.company_name','tbl_user.email')
                ->where('tbl_user.id',$id)
                ->get();
                return response()->json($company);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return response()->json("Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return response()->json("Deleted");
    }
}
