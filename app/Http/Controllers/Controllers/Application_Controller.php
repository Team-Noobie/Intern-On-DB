<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Application;
use App\Models\Advertisement;

class Application_Controller extends Controller
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
            $app = new Application;
            $ad = Advertisement::find($request->ad_id);
            
            $app->ads_id=$request->ad_id;
            $app->company_id=$ad->company_id;
            $app->student_id=$request->student_id;
            $app->save();
                return response()->json($app);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $query = DB::table('tbl_application')
        //         ->join('tbl_user_student','tbl_application.student_id','=','tbl_user_student.user_ID')
        //         ->select('*')
        //         ->where('tbl_application.ads_id',$id)
        //         ->get();

        // $applications = new \stdClass();
        //         foreach($query as $ap => $value){
        //             $applications->$ap = $value;
        //         }

        // $application = Application::where('ads_id',$id)->get();
        // return response()->json($id);
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
    }
    public function show_applicants($id)
    {

        $applications = Advertisement::find($id)->Application;
        foreach ($applications as $application) {
            # code...
            $application->student;
        }
        return response()->json($applications); 

    }

    public function student_show_application($id)
    {
        $applications = Application::where('student_id',$id)->get();
            foreach ($applications as $application) {
              $application->company;
              $application->advertisement;
            }
        return response()->json($applications);
    }
}
