<?php

namespace App\Http\Controllers;

class test2Controller extends BaseGameController
{
	public function index()
	{
		return view('test2');
	}
	
	public static function hoge($a,$b)
	{
	    $c = $a * $b;
	    return $c;
	}
}
