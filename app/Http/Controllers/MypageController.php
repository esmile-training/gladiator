<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;

class MypageController extends BaseGameController
{
	public function index()
	{
	    //DBからとってくる
	    $this->viewData['userList']  = UserModel::getAll();


	    return viewWrap('mypage', $this->viewData);
	}
}
