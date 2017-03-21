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


        //single route       
        Route::post('view_application/{id}','Controllers\Application_Log_Controller@view_application');
        Route::post('hire_applicant/{id}','Controllers\Application_Log_Controller@hire_applicant');
        Route::post('reject_application/{id}','Controllers\Application_Log_Controller@reject_application');
        // Route::post('set_interview/{id}','Controllers\Application_Log_Controller@set_interview');    
        Route::post('interview_result/{id}','Controllers\Application_Log_Controller@interview_result');    
        Route::get('check_set_interview/{id}','Controllers\Application_Log_Controller@check_set_interview'); 
        Route::get('application_view/{id}','Controllers\Application_Log_Controller@application');    



        // Student_Controller
        Route::get('student_profile/{id}','Controllers\Student_Controller@student_profile');
        Route::get('search_advertisement','Controllers\Student_Controller@search_advertisement');
        Route::get('student_view_advertisement/{id}','Controllers\Student_Controller@view_advertisement');        
        Route::post('application_check','Controllers\Student_Controller@application_check');
        Route::post('apply','Controllers\Student_Controller@apply');
        Route::get('application_list/{id}','Controllers\Student_Controller@application_list');
        Route::post('upload_resume','Controllers\Student_Controller@upload_resume');
        
        // Company_Controller
        Route::get('company_profile/{id}','Controllers\Company_Controller@company_profile');
        Route::get('company_advertisement_list/{id}','Controllers\Company_Controller@company_advertisement_list');
        Route::post('create_advertisement','Controllers\Company_Controller@create_advertisement');
        Route::get('company_view_advertisement/{id}','Controllers\Company_Controller@view_advertisement'); 
            //edit post                       
        Route::get('advertisement_application_list/{id}','Controllers\Company_Controller@advertisement_application_list');
        Route::post('advertisement_applicant_list/{id}','Controllers\Company_Controller@advertisement_applicant_list');
        Route::get('view_application/{id}','Controllers\Company_Controller@view_application');
        Route::post('set_interview/{id}','Controllers\Company_Controller@set_interview');    
        
           
    });
});
