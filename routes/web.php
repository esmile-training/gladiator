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


//urlからcontrollerを解釈
Route::get(
	( REDIRECT_URL )? REDIRECT_URL : '/',
	ucfirst(CONTROLLER_NAME).'Controller@'.ACTION_NAME
);

//post用の処理(内容は上と同一)
Route::post(
	( REDIRECT_URL )? REDIRECT_URL : '/',
	ucfirst(CONTROLLER_NAME).'Controller@'.ACTION_NAME
);

//デフォルト以外のルーティングは以下に記述
//Route::get('top', 'mypageController@index');

