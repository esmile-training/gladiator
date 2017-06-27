<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$delChara = $this->Model->exec('Mypage', 'delFlagCheck', $this->user['id']);
		$this->viewData['delFlag'] = $delChara;

		$loginLog = $this->Model->exec('LoginLog', 'check', $this->user['id']);
		if(is_null($loginLog))
		{
			$this->Model->exec('loginLog','insertData',array($this->user['id'], $this->viewData['nowTime']));
			$this->viewData['loginBonusFlag'] = true;
		}
		else
		{
			$this->viewData['loginBonusFlag'] = false;
			if(date('Y-m-d',strtotime($loginLog['updateDate'])) < date('Y-m-d',strtotime($this->viewData['nowTime'])))
			{
				$this->Model->exec('loginLog', 'logUpdate', array($this->user['id'],$loginLog['cnt']+1));
				$this->viewData['loginBonusFlag'] = true;
			}
		}
		$this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);
		return viewWrap('mypage', $this->viewData);
	}
}