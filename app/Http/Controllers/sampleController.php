<?php

namespace App\Http\Controllers;

class sampleController extends Controller
{
     public static function index()
    {  

	$name = htmlspecialchars($_GET["username"]);
	 
	//クッキーの存在の有無と同一ユーザーであるか
	if(!isset($_COOKIE['username']) || $_COOKIE['username'] != $name)
	{
	    //DB検索して存在するユーザーか調べる
	    setcookie('username', $name , 0);
	}
	
	//セッションの存在の有無と同一ユーザーであるか
	if(!isset($_SESSION['username']) || $_SESSION['username'] != $name)
	{
	    //DB検索して存在するユーザーか調べる
	    session_start();
	    $_SESSION['username'] = $name;
	}
	
	return view('omikuji');
    }
}
