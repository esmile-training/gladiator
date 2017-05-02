<?php

namespace App\Http\Controllers;

class RetirementCharaController extends BaseGameController
{	
	public function searchCoach()
	{
		//引退するキャラクターIDの持ち越し
		$id = array('id'=>$_GET['id']);
		//コーチの人数を調べる
		if($this->Model->exec('user', 'countCoach', "", $_COOKIE['userId']) >= 3)
		{
			//コーチが３人いたら
			//ポップアップ処理に変わる可能性あり
			return $this->Lib->redirect('selectCoach',null,$id);
		} else {
			//コーチが二人以下だったらそのままコーチに追加
			return $this->insertCoach($uCharaId);
		}
	}
	
	public function insertCoach($uCharaId){
		//キャラの削除処理
		$this->Model->exec('User','deleteChara',"",$_GET['id']);
		//コーチの追加処理
		$this->Model->exec('User','insertCoach',[$_GET['imgId'], $_GET['name'], $_GET['rare'], $_GET['attribute'], $_GET['hp'], $_GET['gooAtk'], $_GET['choAtk'], $_GET['paaAtk']]);
		return viewWrap('retirementChara');
	}
}
