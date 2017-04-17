<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class MypageController extends BaseGameController
{
    public function index()
    {
	return viewWrap('mypage', $this->viewData);
    }

}
