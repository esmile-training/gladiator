<?php

namespace App\http\Controllers;

class Test3Controller extends Controller
{
    public function index()
    {
	return view('test3');
    }
    
    public static function tetet($sentm)
    {
	$comment = $sentm;
	return $comment;
    }
}
