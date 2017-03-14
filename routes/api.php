<?php

use Illuminate\Http\Request;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/ads', function () {
//     $advertisement = Adverstisement::all();
// });


Route::group(['prefix' => 'internon'], function(){
    Route::post('auth','Auth\AuthController@authenticate');
    
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('auth','Auth\AuthController@getAuthenticatedUser');
        
        // user
        Route::resource('user', 'Controllers\User_Controller');

        //transaction
        Route::resource('ads', 'Controllers\Advertisement_Controller');
        Route::resource('application','Controllers\Application_Controller');


        //single route
        Route::get('company_ads/{id}','Controllers\Advertisement_Controller@Company_Ads');
        Route::get('company_show_applicants/{id}','Controllers\Application_Controller@show_applicants');
        Route::get('student_show_applications/{id}','Controllers\Application_Controller@student_show_application');
        Route::post('checkApplication','Controllers\Advertisement_Controller@Student_Ads');
        
    });
});
