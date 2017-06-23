<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$delChara = $this->Model->exec('Mypage', 'delFlagCheck', $this->user['id']);
		$this->viewData['delFlag'] = $delChara;
		//コンフィグからデータ取得
		$loginBonus = \Config::get('loginBonus.bonusItem');
		
		$loginLog = $this->Model->exec('loginLog', 'check', $this->user['id']);
		if(is_null($loginLog))
		{
			//ログインデータをテーブルに追加
			$this->Model->exec('loginLog','insertData',array($this->user['id'], $this->viewData['nowTime']));
			$this->Model->exec('PresentBox','insertPresentData',array($this->user['id'],$loginBonus[1]['type'],$loginBonus[1]['objId'],
																		$loginBonus[1]['objId'],$loginBonus[1]['cnt']));
			
			$this->viewData['loginBonus'] = $loginBonus;
			//フラグを立ててビューに返す
			$this->viewData['loginBonusFlag'] = true;
		}
		else
		{
			$this->viewData['loginBonusFlag'] = false;
			//最後のログイン後に日付を跨いでおり、かつログイン回数が7回未満の時
			if(date('Y-m-d',strtotime($loginLog['updateDate'])) < date('Y-m-d',strtotime($this->viewData['nowTime'] && $loginLog['cnt'] < 7)))
			{
				$this->Model->exec('loginLog', 'logUpdate', array($this->user['id'],$loginLog['cnt']+1));
				$this->Model->exec('PresentBox','insertPresentData',array($this->user['id'],
									$loginBonus[$loginLog['cnt']]['type'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['cnt']));
				
				$this->viewData['loginBonus'] = $loginBonus;
				//フラグを立ててビューに返す
				$this->viewData['loginBonusFlag'] = true;
			}
			//最後のログイン後に日付を跨いでおり、かつログイン回数が7回の時
			else if(date('Y-m-d',strtotime($loginLog['updateDate'])) < date('Y-m-d',strtotime($this->viewData['nowTime'] && $loginLog['cnt'] == 7)))
			{
				$this->Model->exec('loginLog', 'logUpdate', array($this->user['id'],1));
				$this->Model->exec('PresentBox','insertPresentData',array($this->user['id'],
									$loginBonus[$loginLog['cnt']]['type'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['objId'],$loginBonus[$loginLog['cnt']]['cnt']));
				
				$this->viewData['loginBonus'] = $loginBonus;
				//フラグを立ててビューに返す
				$this->viewData['loginBonusFlag'] = true;
			}
		}
		
		$this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);
		return viewWrap('mypage', $this->viewData);
	}
}