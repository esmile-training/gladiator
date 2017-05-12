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
			
			//初期コーチの作成//修正予定
			$newCoachState = array('imgId' => 1,
									'name' => 'テストコーチ・グー',
									'rare' => 1,
									'attribute' => 'gu',
									'hp' => 300,
									'gooAtk' => '200',
									'choAtk' => '50',
									'paaAtk' => '50');
			$this->Model->exec('Coach','insertCoach',array($newCoachState));
			
			$newCoachState = array('imgId' => 1,
									'name' => 'テストコーチ・チョキ',
									'rare' => 1,
									'attribute' => 'choki',
									'hp' => 300,
									'gooAtk' => '50',
									'choAtk' => '200',
									'paaAtk' => '50');
			$this->Model->exec('Coach','insertCoach',array($newCoachState));
			
			$newCoachState = array('imgId' => 1,
									'name' => 'テストコーチ・パー',
									'rare' => 1,
									'attribute' => 'paa',
									'hp' => 300,
									'gooAtk' => '50',
									'choAtk' => '50',
									'paaAtk' => '200');
			$this->Model->exec('Coach','insertCoach',array($newCoachState));
			//マイページヘリダイレクト
			return $this->Lib->redirect('mypage', 'index');
		} else {
			//文字数がオーバーした場合のポップアップで警告表示予定
			return $this->Lib->redirect('commonError');
		}
	}
}
