<?php

namespace App\Http\Controllers;

class changeCoachController extends BaseGameController
{
	public function index()
	{
		//コーチのステータス取得(DB接続)
		$coachStat = $this->Model->exec('Coach','getById',$_GET['coachId']);
		//キャラのステータス取得(DB接続)
		$charaStat = $this->Model->exec('Chara','getById',$_GET['charaId']);
		//配列を結合
		$Stat = array('coach' =>$coachStat, 'chara' => $charaStat);
		//取得したステータスをビューに渡す
		return viewWrap('changeCoach', $Stat);
	}
	
	public function changeCoach()
	{
		//コーチの削除処理
		$this->Model->exec('Coach', 'deleteCoach', "", $_GET['coachId']);
		//キャラの削除処理
		$this->Model->exec('Chara', 'charaDelFlag', "", $_GET['charaId']);
		//コーチの追加処理
		$newCoachState = array('imgId' => $_GET['charaimgId'],
								'name' => $_GET['charaname'],
								'rare' => $_GET['chararare'],
								'attribute' => $_GET['charaattribute'],
								'hp' => $_GET['charahp'],
								'gooAtk' => $_GET['charagooAtk'],
								'choAtk' => $_GET['charachoAtk'],
								'paaAtk' => $_GET['charapaaAtk']
		);
		$this->Model->exec('Coach', 'insertCoach', array($newCoachState));
		//「コーチに配属しました！」に移動
		return $this->Lib->redirect('retirementChara','addCoachView');
	}
}