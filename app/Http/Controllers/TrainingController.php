<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{

	public function index()
	{
		//訓練が終了しているキャラがいるか確認し、いたらフラグを戻す
		//$this->Lib->exec( 'Training', 'finishCheck', $this->viewData['nowTime']);
		$this->Lib->exec( 'Training', 'uCharaAtkUp');
		//所持しているキャラのデータを持ってくる
		$this->viewData['charaList'] = $this->Model->exec('Training', 'getUserChara', false, $this->user['id']);

		return viewWrap('training',$this->viewData);
	}
	
	public function coachSelect()
	{
		//uCharaIdをGETしviewDataに保持
		$uCharaId = (int)filter_input(INPUT_GET,"uCharaId");
		$this->viewData['uCharaId'] = $uCharaId;

		//所持しているコーチのデータを持ってくる
		$this->viewData['coachList'] = $this->Model->exec('Training', 'getUserCoach', false, $this->user['id']);

		return viewWrap('coachSelect',$this->viewData);
	}
	
	public function setFinishDate()
	{
		//訓練時刻をGETする
		$trainingTime = (int)filter_input(INPUT_GET,"trainingTime");

		//viewに渡したuCharaIdと選択されたuCoachIdをGET
		$uCoachId = (int)filter_input(INPUT_GET,"uCoachId");
		$uCharaId = (int)filter_input(INPUT_GET,"uCharaId");

		//訓練料金を割り出すためにコーチのHPをGET
		$uCoachHp = (int)filter_input(INPUT_GET,"uCoachHp");

		//訓練開始時刻を入れる
		$trainingStartDate = $this->viewData['nowTime'];
		//訓練開始時刻をタイムスタンプに直し訓練時間を加算
		$trainingFinishTs = strtotime("$trainingStartDate +$trainingTime hours");
		//タイムスタンプにした時間を元に戻す
		$trainingFinishDate = date('Y-m-d H:i:s',$trainingFinishTs);

		$trainingData = [
			'uCharaId'				=> $uCharaId,
			'uCoachId'				=> $uCoachId,
			'trainingStartDate'		=> $trainingStartDate,
			'trainingFinishDate'	=> $trainingFinishDate,
			'trainingTime'			=> $trainingTime
		];

		//uCharaIdとuCoachIdとtrainingFinishDateをModelに渡す
		$this->Model->exec('Training','setFinishDate',array($trainingData));

		//マージしたらuMoneyと合わせて使う、訓練の金額を算出して格納
		$trainingFee = $uCoachHp * 10 * $trainingTime * (100 - ($trainingTime - 1) * 3) / 100;
		var_dump($trainingFee);

		//リダイレクト
		return $this->Lib->redirect('training', 'index');
	
	}
}
