<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{
	public function index()
	{
		//訓練が終了しているキャラがいるか確認し、いたらその訓練の情報を取得する
		$result = $this->Lib->exec('Training', 'endCheck', array($this->viewData['nowTime'], $this->user['id'], true));
		if(isset($result))
		{
			foreach($result as $val)
			{
				$endTrainingChara[] = $this->Model->exec('Chara','getById',$val['uCharaId']);
			}
			//訓練が終了したキャラのIDからそのキャラクターの情報を取得する。
			$this->viewData['endTrainingChara'] = $endTrainingChara;
			$this->viewData['isTrainingEndFlag'] = TRUE;
		}else{
			$this->viewData['isTrainingEndFlag'] = FALSE;
		}
		
		//所持しているキャラのデータを持ってくる
		$uCharaData = $this->Model->exec('Chara', 'getUserChara', false, $this->user['id']);
		if(!isset($uCharaData))
		{
			return viewWrap('Error',$this->viewData);
		}else{
			$this->viewData['charaList'] = $uCharaData;
		}
		return viewWrap('training',$this->viewData);
	}
	
	public function coachSelect()
	{
		//uCharaIdをGETしviewDataに保持
		$uCharaId = filter_input(INPUT_GET,"uCharaId");
		$this->viewData['uCharaId'] = $uCharaId;
		
		//今回強化するキャラクターの攻撃力、強化回数の取得
		$uCharaAtkInfo = $this->Model->exec('Training','getUCharaStatus', $uCharaId);
		//所持しているコーチのデータを持ってくる
		$uCoachData = $this->Model->exec('Training', 'getUserCoach', false, $this->user['id']);
		
		if(!isset($uCoachData))
		{
			return viewWrap('Error',$this->viewData);
		}
		
		$cnt = 0;
		foreach($uCoachData as $val)
		{
			for($i = 0; $i < 10; $i++)
			{
				$gooUpProbability[] = $this->Lib->exec('Training','atkUpProbability',
											array($val['gooAtk'],$uCharaAtkInfo['gooAtk'],$uCharaAtkInfo['gooUpCnt']+$i));
				$choUpProbability[] = $this->Lib->exec('Training','atkUpProbability',
											array($val['choAtk'],$uCharaAtkInfo['choAtk'],$uCharaAtkInfo['choUpCnt']+$i));
				$paaUpProbability[] = $this->Lib->exec('Training','atkUpProbability',
											array($val['paaAtk'],$uCharaAtkInfo['paaAtk'],$uCharaAtkInfo['paaUpCnt']+$i));
			}
			$atkUpProbability[$cnt]['gooUpProbability'] = $gooUpProbability;
			$atkUpProbability[$cnt]['choUpProbability'] = $choUpProbability;
			$atkUpProbability[$cnt]['paaUpProbability'] = $paaUpProbability;
			$cnt++;
		}
		
		$this->viewData['coachList'] = $uCoachData;
		$this->viewData['atkUpProbabililty'] = $atkUpProbability;
		
		return viewWrap('coachSelect',$this->viewData);
	}
	
	/*
	 * 訓練情報をデータベースにSET
	 */
	public function infoSet()
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
		$this->Model->exec('Training','setEndDate',array($trainingData,$this->user['id']));
		//キャラクターとコーチの訓練状態を変更
		$this->Model->exec('Training','uCharaStateChange',array($uCharaId,1));
		$this->Model->exec('Training','uCoachStateChange',array($uCoachId,1));
		
		//訓練料金を割り出すためにコーチのHPをGET
		$uCoachHp	 = (int)filter_input(INPUT_GET,"uCoachHp");
		
		//マージしたらuMoneyと合わせて使う、訓練の金額を算出して格納
		$trainingFee = $uCoachHp * 10 * $trainingTime * (100 - ($trainingTime - 1) * 3) / 100;
		$this->Lib->exec('Money','Subtraction',array($this->user,$trainingFee));
		
		//リダイレクト
		return $this->Lib->redirect('training', 'index');
	}
}