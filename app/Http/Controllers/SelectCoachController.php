<?php

namespace App\Http\Controllers;

class SelectCoachController extends BaseGameController
{
	public function index()
	{
		//引退するキャラクターIDの持ち越し
		$id = array('id'=>$_GET['id']);
		//コーチの人数を調べる
		$alluCoach = $this->Model->exec('Training', 'getUserCoach',$_COOKIE['userId']);
		if(count($alluCoach) >= 3)
		{
			//コーチが３人いたら
			// viewDataへ取得したコーチを送る
			$this->viewData['coachList'] = $alluCoach;
			// ビューへデータを渡す
			return viewWrap('SelectCoach',$this->viewData);
		} else {
			//コーチが二人以下だったらそのままコーチに追加
			$this->insertCoach($_GET['id']);
		}
	}
	
	public function setCoach()
	{	
		//引退ボンタンが押されたキャラと選択されたコーチの情報を配列に格納
		$para = array('coachId' => $_GET['uCoachId'], 'charaId' => $_GET['charaId']);
		//確認画面へリダイレクト
		return ($this->Lib->redirect('changeCoach',"", $para));
	}
	
	public function deleteChara()
	{
		//キャラの削除処理
		$this->Model->exec('Chara','charaDelFlag',"",$_GET['id']);
		//「引退しました」へ遷移
		return ($this->Lib->redirect('Error'));
	}
	
	public function insertCoach($uCharaId)
	{
		//キャラの削除処理
		$this->Model->exec('Chara','charaDelFlag',"",$_GET['id']);
		//コーチの追加処理
		$this->Model->exec('Coach','insertCoach',[$_GET['imgId'], $_GET['name'], $_GET['rare'], $_GET['attribute'], $_GET['hp'], $_GET['gooAtk'], $_GET['choAtk'], $_GET['paaAtk']]);
		return ($this->Lib->redirect('retirementChara'));
	}
}
