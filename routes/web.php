<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});


Route::get('/plan',function(){
    return view('plan');
});


Route::get('/login',function(){
    return view('login');
});

Route::get('/set',function(){
    return view('setSession');
});

Route::get('/logout',function(){
	return view('unSetSession');
});

Route::get('/currentPlan',function(){
	return view('currentPlan');
});


Route::get('/profile',function(){
	return view('profile');
});

Route::get('/register',function(){
	return view('register');
});

Route::get('/contactus',function(){
	return view('contactUs');
});






Route::get('register','Auth\RegisterController@showRegistrationForm');

Route::post('register','Auth\RegisterController@create');

Route::group(['prefix' => 'admin'], function () {

	Route::get('/dash', function () {
		return View::make('admin.dashboard');
	});

	Route::group(['prefix' => 'add'], function (){
		Route::get('usergroup', function (){
			return View('admin.add_form.usergroup');
		});

		Route::get('user', function () {
			return View('admin.add_form.user');
		});

		Route::get('plan',function (){
			return View('admin.add_form.plan');
		});

		Route::get('app-permission',function (){
			return View('admin.add_form.app-permission');
		});

		Route::get('app-category',function (){
			return View('admin.add_form.app-category');
		});

		Route::get('app-register',function (){
			return View('admin.add_form.app-register');
		});

		Route::get('app-detail',function (){
			return View('admin.add_form.app_detail');
		});

	});


});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
