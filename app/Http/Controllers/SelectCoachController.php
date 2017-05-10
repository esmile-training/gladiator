<?php

namespace App\Http\Controllers;

class SelectCoachController extends BaseGameController
{
	public function index()
	{
		// DBのコーチデータを取得する
		$alluCoach = $this->Model->exec('Training','getUserCoach');
		// DBからコーチを取得できたかを確認する
		//if(isset($alluCoach))
		if($this->viewData['coachList'])
		{
			// viewDataへ取得したコーチを送る
			$this->viewData['coachList'] = $alluCoach;
			// ビューへデータを渡す
			return viewWrap('SelectCoach');
		}
		else
		{
			// コーチのデータが無ければ、マイページへリダイレクトする
			$this->Lib->redirect('mypage','index');
		}
	}
	
	public function setCoach()
	{	
		$para = array('coachId' => $_GET['uCoachId'], 'charaId' => $_GET['charaId']);
		return ($this->Lib->redirect('changeCoach',"", $para));
	}
	
	public function deleteChara()
	{
		//キャラの削除処理
		$this->Model->exec('User','deleteChara',"",$_GET['id']);
		//「引退しました」へ遷移
		return ($this->Lib->redirect('Error'));
	}
}
