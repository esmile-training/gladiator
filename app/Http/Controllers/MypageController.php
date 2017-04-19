<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		return viewWrap('mypage', $this->viewData);
    }
    //php
}
