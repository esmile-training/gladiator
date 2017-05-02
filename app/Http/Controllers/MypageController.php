<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
	//$this->Lib->exec( 'Training', 'finishCheck', $this->viewData['nowTime']);
	$this->Lib->exec('weekRange', 'rangeState', $this->user['id']);
	return viewWrap( 'mypage', $this->viewData);
	}
}

