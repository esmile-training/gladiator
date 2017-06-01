<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$delChara = $this->Model->exec('Mypage', 'delFlagCheck', $this->user['id']);
		$this->viewData['delFlag'] = $delChara;
	
		$this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);
		return viewWrap('mypage', $this->viewData);
	}
}

