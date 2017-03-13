<?php

namespace App\Http\Controllers\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Advertisement;
use App\Models\User_Company;

class Advertisement_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $advertisements = Advertisement::all();
            foreach ($advertisements as $advertisement) {
                $advertisement->Company;
            }
        return response()->json($advertisements);
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
            $ad = new Adverstisement;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Advertisement::find($id);
        $ad->Company;
        $ad->ads_requirement = explode(',',$ad->ads_requirement);
        return response()->json($ad);
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
    
    public function Company_Ads($id){
        $company = User_Company::where('user_ID',$id)->get();
        foreach ($company[0]->Advertisements as $advertisement) {
            $advertisement->count = $advertisement->Application->count();
        }
        return response()->json($company[0]->Advertisements);
    }
}