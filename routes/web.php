<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('t/{id?}/{name?}', 'Admin\TestController@index')->name('profile');


Route::group(['prefix' => 'admin'], function () {
    Route::get('t/{age}', function ($age) {
        // 匹配 "/admin/users" URL
        //echo $age;
        return view('child');
    })->middleware('checknum');

    Route::get('t', function(){
    	return view('child',['name'=>['emily','ivan']]);
    });


    Route::get('t/{id?}/{name?}', 'Admin\TestController@index')->name('profile');
});
