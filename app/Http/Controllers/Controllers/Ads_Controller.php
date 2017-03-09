<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Company_Ads;

class Ads_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ads = DB::table('tbl_advertisement')
                ->join('tbl_user_company','tbl_advertisement.company_id','=','tbl_user_company.user_ID')
                ->select('*')
                // ->where('tbl_advertisement.ads_id',$id)
                ->get();
                return response()->json($ads);

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
        if($request->type == 'save'){
            $ad = new Company_Ads;
            $ad->company_id = $request->id;
            $ad->ads_title = $request->ad_title;
            $ad->ads_requirement = implode(",",$request->ad_requirements);
            $ad->ads_tags = $request->ad_tags;
            $ad->ads_responsibility = implode(",",$request->ad_responsibilities);
            $ad->ads_contact = implode(",",$request->ad_contacts);
            $ad->ads_visibility = "Visible";
            $ad->save();
                return response()->json($request);
        }

        if($request->type == 'search')
            return response()->json($request);

        if($request->type == 'show'){
            $query = Company_Ads::where('company_id',$request->id)->get();
            $ads = new \stdClass();
            foreach($query as $ad => $value){
                $count = DB::table('tbl_advertisement')
                ->join('tbl_application','tbl_advertisement.ads_id','=','tbl_application.ads_id')
                ->select('*')
                ->where('tbl_advertisement.ads_id',$value->ads_id)
                ->count();
                $value->application_count = $count;
                $ads->$ad = $value;
            }
            return response()->json($ads);
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
        
        // $ad = Company_Ads::find($id);
        // return response()->json($ad);
        
        $query = DB::table('tbl_advertisement')
                ->join('tbl_user_company','tbl_advertisement.company_id','=','tbl_user_company.user_ID')
                ->select('*')
                ->where('tbl_advertisement.ads_id',$id)
                ->get();
                $ads = new \stdClass();
                foreach($query as $ad => $value){
                    $ads->$ad = $value;
                }
                $ads->$ad->ads_requirement = explode(",",$ads->$ad->ads_requirement);
                $ads->$ad->ads_responsibility = explode(",",$ads->$ad->ads_responsibility);
                $ads->$ad->ads_contact = explode(",",$ads->$ad->ads_contact);
                return response()->json($ads);
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

class ad{
    function showads($ads){
        return $ads;
    }
}