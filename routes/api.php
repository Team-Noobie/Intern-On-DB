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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


Route::group(['prefix' => 'internon'], function(){
    Route::post('register','Controllers\User_Controller@store');
    Route::post('auth','Auth\AuthController@authenticate');
    
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('auth','Auth\AuthController@getAuthenticatedUser');
        
        // user
        Route::get('register/{id}','Controllers\User_Controller@show');
        Route::put('register/{id}', 'Controllers\User_Controller@update');
        Route::delete('register/{id}','Controllers\User_Controller@destroy');


        Route::resource('ads', 'Controllers\Ads_Controller');
        Route::resource('application','Controllers\Application_Controller');

    });
});
