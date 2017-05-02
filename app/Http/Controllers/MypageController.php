<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$this->Lib->exec( 'Training', 'finishCheck', $this->viewData['nowTime']);
		return viewWrap( 'mypage', $this->viewData);
	}
}
