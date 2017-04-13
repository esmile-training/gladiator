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
$redirectUrl	= ( isset( $_SERVER['REDIRECT_URL'] ) )? explode('/', $_SERVER['REDIRECT_URL']) : array();
$controllerName = ( isset($redirectUrl[1]) )? $redirectUrl[1] : 'top';
$actionName	= ( isset($redirectUrl[2]) )? $redirectUrl[2] : 'index' ;
Route::get(
	( isset( $_SERVER['REDIRECT_URL'] ) )? $_SERVER['REDIRECT_URL'] : '/',
	ucfirst($controllerName).'Controller@'.$actionName
);

//デフォルト以外のルーティングは以下に記述
//Route::get('top', 'mypageController@index');

