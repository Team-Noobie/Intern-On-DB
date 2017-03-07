<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Application;
use App\Models\Company_Ads;

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
        if($request->user=='student' && $request->type=='apply'){
            $app = new Application;
            $ad = Company_Ads::find($request->ad_id);
            
            $app->ads_id=$request->ad_id;
            $app->company_id=$ad->company_id;
            $app->student_id=$request->student_id;
            $app->save();
                return response()->json($request);
        }

        if($request->user=='company' && $request->type=='show_applications'){
            $query = Application::where('company_id',$request->id)->get();
            $apps = new \stdClass();
            foreach($query as $app => $value){
                $apps->$app = $value;
            }
            return response()->json($apps);
        }

        if($request->user=='student' && $request->type=='show_applications'){
            // $query = Application::where('student_id',$request->id)->get();
            // $apps = new \stdClass();
            // foreach($query as $app => $value){
            //     $apps->$app = $value;
            // }
            // return response()->json($apps);

            $query = DB::table('tbl_application')
                ->join('tbl_advertisement','tbl_application.ads_id','=','tbl_advertisement.ads_id')
                ->join('tbl_user_company','tbl_application.company_id','=','tbl_user_company.user_ID')
                ->select('*')
                ->where('tbl_application.student_id',$request->id)
                ->get();
                $apps = new \stdClass();
                foreach($query as $ap => $value){
                    $apps->$ap = $value;
                }
                return response()->json($apps);

        }
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
        // $query = Application::where('ads_id',$id)->get();

        $query = DB::table('tbl_application')
                ->join('tbl_user_student','tbl_application.student_id','=','tbl_user_student.user_ID')
                ->select('*')
                ->where('tbl_application.ads_id',$id)
                ->get();


        $applications = new \stdClass();
                foreach($query as $ap => $value){
                    $applications->$ap = $value;
                }
        return response()->json($applications);
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
}
