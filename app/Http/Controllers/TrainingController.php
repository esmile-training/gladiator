<?php

namespace App\Http\Controllers;

class TrainingController extends BaseGameController
{
	public function index()
	{
		//デフォルト処理
		$type = (!isset($_GET['type']))? 'id' : $_GET['type'];
		$order = (!isset($_GET['order']))? 'ASC' : $_GET['order'];
		return $this->trainingCharaSelect($type, $order);
	}

	public function trainingCharaSelect($type, $order)
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
		$uCharaData = $this->Model->exec('Chara', 'getAllUserChara', false, $this->user['id']);
		// キャラ所持数の最大値と現在値を取得する
		$charaInventory = array();
		$charaInventory['upperLimit'] = $this->Lib->exec('ManageCharaPossession','getUpperLimitChara',$this->user['id']);
		$charaInventory['possession'] = $this->Lib->exec('ManageCharaPossession','getPossessionChara',$this->user['id']);
		// viewDataへ格納する
		$this->viewData['charaInventory'] = $charaInventory;
		
		// 所持している 訓練時間短縮アイテム(trainigShorter) の数を持ってくる
		$trainigShorter = $this->Model->exec('Item', 'getTrainigShorter', false, $this->user['id']);
		$this->viewData['shorterNumber'] = $trainigShorter;

		// 訓練時間短縮アイテムのデータを item config から持ってくる
		$trainigShorterData = \Config::get('item.itemStr.4');
		$this->viewData['shorterData'] = $trainigShorterData;
		
		if(isset($uCharaData))
		{
			//ソート関数の代に引数への変換
			$order = ($order == 'ASC')? false : true;
			//並べ替え処理
			$uCharaData = $this->Lib->exec('Sort','sortArray',[$uCharaData, $type, $order]);
			// viewDataへ取得したキャラクターを送る
			$this->viewData['charaList'] = $uCharaData;
			// ビューへデータを渡す
			return viewWrap('training', $this->viewData);
		}
		else
		{
			//キャラクターがいない場合リストを空にして渡す
			$this->viewData['charaList'] = null;
			// ビューへデータを渡す
			return viewWrap('training',$this->viewData);
		}
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

		$this->viewData['coachList'] = $uCoachData;


		$cnt = 0;
		foreach($uCoachData as $val)
		{
			for($i = 0; $i < 10; $i++)
			{
				$this->viewData['gooUpProbability'][$cnt][] = $this->Lib->exec('Training','atkUpProbability',
											array($val['gooAtk'],$uCharaAtkInfo['gooAtk'],$uCharaAtkInfo['gooUpCnt']+$i));
				$this->viewData['choUpProbability'][$cnt][] = $this->Lib->exec('Training','atkUpProbability',
											array($val['choAtk'],$uCharaAtkInfo['choAtk'],$uCharaAtkInfo['choUpCnt']+$i));
				$this->viewData['paaUpProbability'][$cnt][] = $this->Lib->exec('Training','atkUpProbability',
											array($val['paaAtk'],$uCharaAtkInfo['paaAtk'],$uCharaAtkInfo['paaUpCnt']+$i));
			}
			$cnt++;
		}

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
