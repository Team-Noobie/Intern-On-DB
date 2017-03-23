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
        Route::get('advertisement_application_list/{id}','Controllers\Company_Controller@advertisement_application_list');
        Route::post('advertisement_applicant_list/{id}','Controllers\Company_Controller@advertisement_applicant_list');
        Route::get('view_application/{id}','Controllers\Company_Controller@view_application');
        Route::post('set_interview/{id}','Controllers\Company_Controller@set_interview');    
        Route::get('get_schedules/{id}','Controllers\Company_Controller@get_schedules');    
        Route::get('hire_applicant/{id}','Controllers\Company_Controller@hire_applicant');
        Route::get('intern_list/{id}','Controllers\Company_Controller@intern_list');
        Route::post('interview_result/{id}','Controllers\Company_Controller@interview_result');
        Route::get('reject_application/{id}','Controllers\Company_Controller@reject_application');

        //Coordinator_Controller 
        Route::get('coordinator_profile/{id}','Controllers\Coordinator_Controller@coordinator_profile');
        Route::post('create_student_section','Controllers\Coordinator_Controller@create_student_section');
        Route::post('enroll_student','Controllers\Coordinator_Controller@enroll_student');
        Route::get('section_list','Controllers\Coordinator_Controller@section_list');

        //Administrator_Controller
        Route::get('administrator_module/{id}','Controllers\Administrator_Module_Controller@administrator_module');
        Route::post('create_company_account','Controllers\Administrator_Module_Controller@create_company_account');
        Route::get('company_accounts_list','Controllers\Administrator_Module_Controller@company_accounts_list');

        //HR_Controller



        //SV_Controller
        

    });
});
