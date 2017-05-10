<?php

namespace App\Http\Controllers;

class EditController extends BaseGameController
{
	public function index()
	{
	return viewWrap('edit');
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
			
			//Cookieの値をuserIDに書き換え
			setcookie('userId', $userId, time() + 60*60*24*365*20, '/');

			//マイページヘリダイレクト
			return $this->Lib->redirect('mypage', 'index');
		} else {
			//文字数がオーバーした場合のポップアップで警告表示予定
			return viewWrap('error');
		}
	}
}
