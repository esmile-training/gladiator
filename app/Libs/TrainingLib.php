<?php
namespace App\Libs;

class TrainingLib extends BaseGameLib
{
	/*
	 * 訓練が終了しているか確認する
	 */
//	public function finishCheck($nowTime)
//	{
//		//$trainingState = 0;
//
//		$trainingInfo = $this->Model->exec('Training', 'getTrainingInfo', false, $this->user['id']);
//
//		if(isset($trainingInfo['finishDate']))
//		{
//			foreach( $trainingInfo as $key => $val)
//			{
//				if($val['finishDate'] <= $nowTime)
//				{
//					//uCharaAtkUp($val['id']);
//					//$this->Model->exec( 'Training', 'uCharaStateChange', array($val['uCharaId'],$trainingState), $this->user['id']);
//				}
//			}
//		}
//	}

	public function uCharaAtkUp()
	{
		$trainingId = 21;
		
		//uTrainingテーブルの情報取得
		$trainingInfo = $this->Model->exec('Training','getTrainingInfo',$trainingId);
		foreach($trainingInfo as $key)
		{
			//訓練時間取得
			$time		= (int)$key['time'];
			$uCoachId	= (int)$key['uCoachId'];
			$uCharaId	= (int)$key['uCharaId'];
		}
		
		//コーチの攻撃力取得
		$uCoachAtk = $this->Model->exec('Training','getUCoachAtk', $uCoachId);
		foreach($uCoachAtk as $key)
		{
			$coachGooAtk = (int)$key['gooAtk'];
			$coachChoAtk = (int)$key['choAtk'];
			$coachPaaAtk = (int)$key['paaAtk'];
		}
		
		//キャラの攻撃力取得
		$uCharaAtk = $this->Model->exec('Training','getUCharaAtk', $uCharaId);
		foreach($uCharaAtk as $key)
		{
			$charaGooAtk	= (int)$key['gooAtk'];
			$charaChoAtk	= (int)$key['choAtk'];
			$charaPaaAtk	= (int)$key['paaAtk'];
			$gooUpCnt		= (int)$key['gooUpCnt'];
			$choUpCnt		= (int)$key['choUpCnt'];
			$paaUpCnt		= (int)$key['paaUpCnt'];
		}
		
		//コーチのグー、チョキ、パーそれぞれの攻撃力とキャラのグー、チョキ、パーそれぞれの攻撃力から上昇率を算出
		for($i = 0; $i <= $time; $i++)
		{
			$gooResult = $coachGooAtk / $charaGooAtk * 0.5 * (100 - $gooUpCnt);
			$choResult = $coachChoAtk / $charaChoAtk * 0.5 * (100 - $choUpCnt);
			$paaResult = $coachPaaAtk / $charaPaaAtk * 0.5 * (100 - $paaUpCnt);
			
			$judgeValue = rand(1, 100);
			if($gooResult <= $judgeValue)
			{
				$charaGooAtk++;
				$gooUpCnt++;
			}
			if($choResult <= $judgeValue)
			{
				$charaChoAtk++;
				$choUpCnt++;
			}
			if($paaResult <= $judgeValue)
			{
				$charaPaaAtk++;
				$paaUpCnt++;
			}
		}
		$this->Model->exec('Training', 'updateAtk',array($charaGooAtk,$charaChoAtk,$charaPaaAtk,$uCharaId));
	}

}