<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{
	public function index()
	{
		//訓練が終了しているキャラがいるか確認し、いたらフラグを戻す
		$this->Lib->exec('Training', 'endCheck', array($this->viewData['nowTime'],true));
		//所持しているキャラのデータを持ってくる
		$uCharaData = $this->Model->exec('UChara', 'getUserChara', false, $this->user['id']);
		
		if(!isset($uCharaData))
		{
			echo '訓練可能な剣闘士が一人もいません';
			return viewWrap('Error',$this->viewData);
		}else{
			$this->viewData['charaList'] = $uCharaData;
		}
		
		return viewWrap('training',$this->viewData);
	}
	
	public function coachSelect()
	{
		//uCharaIdをGETしviewDataに保持
		$uCharaId = (int)filter_input(INPUT_GET,"uCharaId");
		$this->viewData['uCharaId'] = $uCharaId;

		//所持しているコーチのデータを持ってくる
		$uCoachData = $this->Model->exec('Training', 'getUserCoach', false, $this->user['id']);
		
		if(!isset($uCoachData))
		{
			echo '訓練可能なコーチが一人もいません';
			return viewWrap('Error',$this->viewData);
		}else{
			$this->viewData['coachList'] = $uCoachData;
		}
		
		return viewWrap('coachSelect',$this->viewData);
	}
	
	public function setInfo()
	{
		//訓練時刻をGETする
		$trainingTime	= (int)filter_input(INPUT_GET,"trainingTime");
		
		//viewに渡したuCharaIdと選択されたuCoachIdをGET
		$uCoachId		= (int)filter_input(INPUT_GET,"uCoachId");
		$uCharaId		= (int)filter_input(INPUT_GET,"uCharaId");

		//訓練開始時刻を入れる
		$trainingStartDate	= $this->viewData['nowTime'];
		//訓練開始時刻をタイムスタンプに直し訓練時間を加算
		$trainingEndTs		= strtotime("$trainingStartDate +$trainingTime hours");
		//タイムスタンプにした時間を元に戻す
		$trainingEndDate	= date('Y-m-d H:i:s',$trainingEndTs);

		//訓練情報を配列に入れる
		$trainingData = [
			'uCharaId'				=> $uCharaId,
			'uCoachId'				=> $uCoachId,
			'trainingStartDate'		=> $trainingStartDate,
			'trainingEndDate'		=> $trainingEndDate,
			'trainingTime'			=> $trainingTime
		];

		//TrainingModelのsetEndDateに訓練情報を渡す
		$this->Model->exec('Training','setEndDate',array($trainingData));
		//キャラクターとコーチの訓練状態を変更
		$this->Model->exec('Training','uCharaStateChange',array($uCharaId,1));
		$this->Model->exec('Training','uCoachStateChange',array($uCoachId,1));

		//訓練料金を割り出すためにコーチのHPをGET
		//$uCoachHp		= (int)filter_input(INPUT_GET,"uCoachHp");
		//マージしたらuMoneyと合わせて使う、訓練の金額を算出して格納
		//$trainingFee = $uCoachHp * 10 * $trainingTime * (100 - ($trainingTime - 1) * 3) / 100;

		//リダイレクト
		return $this->Lib->redirect('training', 'index');
	
	}
}
