<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$delChara = $this->Model->exec('Mypage', 'delFlagCheck', $this->user['id']);
		$this->viewData['delFlag'] = $delChara;
		//ログインボーナスアイテム取得
		$loginBonus = \Config::get('loginBonus.bonusItem');

		$loginLog = $this->Model->exec('LoginLog', 'check', $this->user['id']);
		if(is_null($loginLog))
		{
			//初めてログインした時にログインデータ作成
			$this->Model->exec('loginLog','insertData',array($this->user['id'], $this->viewData['nowTime']));
			$this->Model->exec('Presentbox','insertPresentData',array($this->user['id'],$loginBonus[1]['type'],$loginBonus[1]['objId'],
																		$loginBonus[1]['objId'],$loginBonus[1]['cnt']));
			
			$this->viewData['loginBonus'] = $loginBonus[1];
			$this->viewData['loginBonusFlag'] = true;
		}
		else
		{
			$this->viewData['loginBonusFlag'] = false;
			
			//前回のログインから日付がかわっていたら
			if(date('Y-m-d',strtotime($loginLog['updateDate'])) < date('Y-m-d',strtotime($this->viewData['nowTime'])))
			{
				$loginCnt = $this->Lib->exec('LoginBonus','typeCheck',array($this->user['id'],$loginBonus,$loginLog));
				$this->viewData['loginBonus'] = $loginBonus[$loginCnt];
				$this->viewData['loginBonusFlag'] = true;
			}
		}
		
		$this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);
		return viewWrap('mypage', $this->viewData);
	}
}