<?php

namespace App\Http\Controllers;

class sample2Controller extends Controller
{
    public static function index()
    {
	$player = array("name" => $_GET["PlayerName"],"age" => $_GET["PlayerAge"],"seibetsu" => $_GET["seibetsu"]);
	return view("test3", compact('player'));
    }
}