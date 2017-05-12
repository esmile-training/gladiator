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
		return $this->Lib->redirect('retirementChara','retireCharaView');
	}
	
	public function insertCoach($uCharaId)
	{
		//キャラの削除処理
		$this->Model->exec('Chara','charaDelFlag',"",$_GET['id']);
				//コーチの追加処理
		$newCoachState = array('imgId' => $_GET['imgId'],
								'name' => $_GET['name'],
								'rare' => $_GET['rare'],
								'attribute' => $_GET['attribute'],
								'hp' => $_GET['hp'],
								'gooAtk' => $_GET['gooAtk'],
								'choAtk' => $_GET['choAtk'],
								'paaAtk' => $_GET['paaAtk']
		);
		$this->Model->exec('Coach', 'insertCoach', array($newCoachState));
		//「コーチに配属しました！」に移動
		return $this->Lib->redirect('retirementChara','addCoachView');
	}
}
