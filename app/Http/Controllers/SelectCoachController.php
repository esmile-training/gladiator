<?php

namespace App\Http\Controllers;

class SelectCoachController extends BaseGameController
{
	public function index()
	{
		$userId = $_COOKIE['userId'];
		// DBのコーチデータを取得する
		$alluCoach = $this->Model->exec('Training','getUserCoach',$userId);

		// DBからコーチを取得できたかを確認する
		if(isset($alluCoach))
		{
			// viewDataへ取得したコーチを送る
			$this->viewData['coachList'] = $alluCoach;
			// ビューへデータを渡す
			return viewWrap('SelectCoach',$this->viewData);
		}
		else
		{
			// コーチのデータが無ければ、マイページへリダイレクトする
			$this->Lib->redirect('mypage','index');
		}
	}
	
	public function setCoach()
	{
		$coachId = $_GET['uCoachId'];
		$selectedCoach= $this->Model->exec('Training','getById',$coachId);
		return ($this->Lib->redirect('changeCoach',"", $selectedCoach));
		exit;
	}
	
	public function deleteChara()
	{
		//キャラの削除処理
		//$this->Model->exec('User','deleteChara',"",$_GET['id']);
		return ($this->Lib->redirect('Error'));
	}
}
