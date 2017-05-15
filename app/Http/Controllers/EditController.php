<?php

namespace App\Http\Controllers;

class EditController extends BaseGameController
{
	public function index()
	{
		return view('edit');
	}

	public function addUser()
	{
		//bladeから入力された値を取得
		$teamName = $_GET["teamName"];

		//チーム名をバイトと文字数で判定
		if(strlen($teamName) <= 16 || mb_strlen($teamName) <= 8)
		{   
			//チーム名の確認ポップアップの生成

			//DBにチーム名を追加してidを取得
			$userId = $this->Model->exec('User', 'createUser', [$teamName]);
			
			// rankingにデータを追加
			$this->Model->exec('Ranking','insertRankingData',$userId);
			
			//Cookieの値をuserIDに書き換え
			setcookie('userId', $userId, time() + 60*60*24*365*20, '/');
			
			//初期コーチの作成
			$this->addCoach('グー', 'goo', 0);
			$this->addCoach('チョキ', 'choki', 1);
			$this->addCoach('パー', 'paa', 2);
			
			//マイページヘリダイレクト
			return $this->Lib->redirect('mypage', 'index');
		} else {
			//文字数がオーバーした場合のポップアップで警告表示予定
			return $this->Lib->redirect('commonError');
		}
	}
	
	public function  addCoach($name, $att, $Atk)
	{
		$atkArray = array('50', '50', '50');
		$atkArray[$Atk] = 200;
		$newCoachState = array('imgId' => 1,
									'name' => 'テストコーチ・'.$name,
									'rare' => 1,
									'attribute' => $att,
									'hp' => 300,
									'gooAtk' => $atkArray[0],
									'choAtk' => $atkArray[1],
									'paaAtk' => $atkArray[2]);
		$this->Model->exec('Coach','insertCoach',array($newCoachState));
	}
}
