<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class LoginController extends Controller
{
	public function createUser()
	{
	    UserModel::createUser();
	    //リダイレクト
	    header( "Location: ".APP_URL.'top' );
	    exit();
	}
}
