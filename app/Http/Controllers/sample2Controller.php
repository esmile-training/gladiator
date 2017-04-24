<?php

namespace App\Http\Controllers;

class sample2Controller extends BaseGameController
{
    public static function index()
    {
	$player = $_GET["teamName"];
	$this->Model->exec('User', 'createUser', false, $player);
	//$userId = $this->Model->exec('User','getById');
	//setcookie('userId',$userId,time() + 60*60*24*365*20, '/');
	return view('mypage');
    }
}