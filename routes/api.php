<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin'], function (){

	Route::group(['prefix' => 'add'], function (){


		Route::resource('usergroup','UsergroupsController',['only' => [
			'store','update','index','destroy'
		]]);

		Route::resource('user','UsersController');

		Route::post('user-sort','UsersController@userByUsergroup');
		// Route::get('usergroup-get','UsergroupsController@index');

		Route::resource('plan','PlansController',['only' => [
			'store'
		]]);

		Route::resource('app-cat','AppCategoriesController',['only' => [
			'store'
		]]);



		Route::resource('subscription-month','SubscriptionMonthsController',['only'=>['store']]);

		Route::resource('app-permission','ApkPermissionsController',['only'=>['store']]);

		Route::resource('app','AppsController',['only'=>['store']]);

		Route::resource('app-detail','AppDetailsController',['only'=>['store']]);



	});

	Route::group(['prefix'=>'update'], function (){

		Route::resource('plan','PlansController',['only'=>['update']]);

		Route::resource('subscription-month','SubscriptionMonthsController',['only'=>['update']]);

		Route::resource('app-cat','AppCategoriesController',['only'=>['update']]);

		Route::resource('app-permission','ApkPermissionsController',['only'=>['update']]);

		Route::resource('app','AppsController',['only'=>['update']]);

		Route::resource('app-detail','AppDetailsController',['only'=>['update']]);

		Route::patch('user-pass/{id}','UsersController@changePass');

		
	});
	
	Route::group(['prefix'=>'delete'], function (){
		Route::resource('plan','PlansController',['only'=>['destroy']]);

		Route::resource('app-cat','AppCategoriesController',['only'=>['destroy']]);

		Route::resource('subscription-month','SubscriptionMonthsController',['only'=>['destroy']]);

		Route::resource('app-permission','ApkPermissionsController',['only'=>['destroy']]);

		Route::resource('app','AppsController',['only'=>['destroy']]);

		Route::resource('app-detail','AppDetailsController',['only'=>['destroy']]);

		

	});

	
});



Route::group(['prefix'=>'user'], function (){

	// return print_r("ghdbnj");

	Route::resource('subscribe','UserPlansController');
	

});


Route::resource('plan','PlansController',['only' => [
		'index','show'
	]]);

Route::resource('app-cat','AppCategoriesController',['only' => [
		'index'
	]]);


	
Route::resource('subscription-month','SubscriptionMonthsController',['only'=>['index']]);

Route::resource('app-permission','ApkPermissionsController',['only'=>['index']]);


Route::resource('app','AppsController',['only'=>['index','show']]);

Route::get('app-in/{id}','AppsController@indexApp');

Route::resource('app-detail','AppDetailsController',['only'=>['index','show']]);

Route::get('app-detail-last/{id}','AppDetailsController@showLast');

Route::get('app-flush','AppsController@flushAppSession');

Route::get('app-show/{id}','AppsController@showApp');

Route::post('login-check','AuthController@loginCheck');
Route::post('login-checkapi','AuthController@loginCheckApi');

Route::get('logout','AuthController@logout');

Route::post('app-user','AuthController@apiForAndroid');


Route::resource('user','UsersController',['only'=>['index','show']]);

Route::get('sendmail','MailController@basic_email');