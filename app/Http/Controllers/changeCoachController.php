<?php

namespace App\Http\Controllers;

class changeCoachController extends BaseGameController
{
	public function index()
	{
		//コーチのステータス取得(DB接続)
		$coachStat = $this->Model->exec('training','getById',$_GET['coachId']);
		//キャラのステータス取得(DB接続)
		$charaStat = $this->Model->exec('UChara','getById',$_GET['charaId']);
		//配列を結合
		$Stat = array('coach' =>$coachStat, 'chara' => $charaStat);
		//取得したステータスをビューに渡す
		return viewWrap('changeCoach', $Stat);
	}
	
	public function changeCoach()
	{
		//コーチの削除処理
		$this->Model->exec('User', 'deleteCoach', "", $_GET['coachId']);
		//キャラの削除処理
		$this->Model->exec('User', 'deleteChara', "", $_GET['charaId']);
		//コーチの追加処理
		$this->Model->exec('User', 'insertCoach', [$_GET['charaimgId'], $_GET['charaname'], $_GET['chararare'], $_GET['charaattribute'], $_GET['charahp'], $_GET['charagooAtk'], $_GET['charachoAtk'], $_GET['charapaaAtk']]);
		//「コーチに配属しました！」に移動
		return viewWrap('retirementChara');
	}
}