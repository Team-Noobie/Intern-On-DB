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
        Route::get('search_advertisement/{id}','Controllers\Student_Controller@search_advertisement');
        Route::get('student_view_advertisement/{id}','Controllers\Student_Controller@view_advertisement');        
        Route::post('apply','Controllers\Student_Controller@apply');
        Route::get('application_list/{id}','Controllers\Student_Controller@application_list');
        Route::get('student_schedule/{id}','Controllers\Student_Controller@student_schedule');        
        Route::post('upload_resume','Controllers\Student_Controller@upload_resume');
        
        // Company_Controller
        Route::get('company_profile/{id}','Controllers\Company_Controller@company_profile');
        Route::get('company_advertisement_list/{id}','Controllers\Company_Controller@company_advertisement_list');
        Route::post('create_advertisement','Controllers\Company_Controller@create_advertisement');
        Route::get('company_view_advertisement/{id}','Controllers\Company_Controller@view_advertisement'); 
        Route::post('set_interview/{id}','Controllers\Company_Controller@set_interview');    
        Route::get('get_schedules/{id}','Controllers\Company_Controller@get_schedules');    
        Route::post('hire_applicant/{id}','Controllers\Company_Controller@hire_applicant');
        Route::get('intern_list/{id}','Controllers\Company_Controller@intern_list');
        Route::post('interview_result/{id}','Controllers\Company_Controller@interview_result');
        Route::get('reject_application/{id}','Controllers\Company_Controller@reject_application');
        Route::get('company_application_list/{id}','Controllers\Company_Controller@company_application_list');
        Route::get('department_list/{id}','Controllers\Company_Controller@department_list');                
        Route::post('create_department/{id}','Controllers\Company_Controller@create_department');        
        Route::get('hr_list/{id}','Controllers\Company_Controller@hr_list');
        Route::post('create_hr/{id}','Controllers\Company_Controller@create_hr');                                        
        Route::get('sv_list/{id}','Controllers\Company_Controller@sv_list');                
        Route::post('create_sv/{id}','Controllers\Company_Controller@create_sv');                
        

        //Coordinator_Controller 
        Route::get('coordinator_profile/{id}','Controllers\Coordinator_Controller@coordinator_profile');
        Route::post('create_student_section/{id}','Controllers\Coordinator_Controller@create_student_section');
        Route::post('enroll_student/{id}','Controllers\Coordinator_Controller@enroll_student');
        Route::get('section_list/{id}','Controllers\Coordinator_Controller@section_list');
        Route::get('view_section_students/{id}','Controllers\Coordinator_Controller@view_section_students');

        //Administrator_Controller
        Route::get('administrator_module','Controllers\Administrator_Module_Controller@administrator_module');
        Route::post('create_company_account','Controllers\Administrator_Module_Controller@create_company_account');
        Route::post('create_coordinator_account','Controllers\Administrator_Module_Controller@create_coordinator_account');
        Route::get('company_accounts_list','Controllers\Administrator_Module_Controller@company_accounts_list');
        Route::get('coordinator_accounts_list','Controllers\Administrator_Module_Controller@coordinator_accounts_list');
        

        //HR_Controller
        Route::get('hr_profile/{id}','Controllers\HR_Controller@hr_profile');
        Route::get('hr_application/{id}','Controllers\HR_Controller@hr_application');
        // Route::get('hr_view_application/{id}','Controllers\HR_Controller@hr_view_application');
        Route::get('hr_advertisement_list/{id}','Controllers\HR_Controller@hr_advertisement_list');
        Route::get('hr_application_list/{id}','Controllers\HR_Controller@hr_application_list');
        //SV_Controller
        Route::get('sv_profile/{id}','Controllers\SV_Controller@sv_profile');

    });
});
