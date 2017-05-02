<?php

namespace App\Http\Controllers;

class SelectCoachController extends BaseGameController
{
	public function index()
	{
		$userId = $_COOKIE['userId'];
		// DBのキャラクターデータを取得する
		$alluCoach = $this->Model->exec('Training','getUserCoach',$userId);

		// DBからキャラクターを取得できたかを確認する
		if(isset($alluCoach))
		{
			// viewDataへ取得したキャラクターを送る
			$this->viewData['coachList'] = $alluCoach;
			// ビューへデータを渡す
			return viewWrap('SelectCoach',$this->viewData);
		}
		else
		{
			// キャラクターのデータが無ければ、マイページへリダイレクトする
			$this->Lib->redirect('mypage','index');
		}
	}
}
