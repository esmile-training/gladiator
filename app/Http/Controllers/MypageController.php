<?php

namespace App\Http\Controllers;
//Model
//Lib

class MypageController extends BaseGameController
{
	public function index()
	{
	    return viewWrap('mypage', $this->viewData);
	}
}
