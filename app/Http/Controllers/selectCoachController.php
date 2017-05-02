<?php

namespace App\Http\Controllers;

class SelectCoachController extends BaseGameController
{
	public function index(){
		$userId = $_COOKIE['userId'];
		// DBのキャラクターデータを取得する
		$alluCoach = $this->Model->exec('Training','getUserCoach',$userId);
		var_dump($alluCoach);exit;

		// DBからキャラクターを取得できたかを確認する
		if(isset($alluCoach))
		{
			// viewDataへ取得したキャラクターを送る
			$this->viewData['List'] = $alluCoach;
			// ビューへデータを渡す
			return viewWrap('selectCoach',$this->viewData);
		}
		else
		{
			// キャラクターのデータが無ければ、マイページへリダイレクトする
			$this->Lib->redirect('mypage','index');
		}
	}
}
