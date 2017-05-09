<?php
namespace App\Libs;

class TrainingLib extends BaseGameLib
{
	/*
	 * 訓練が終了しているか確認する
	 */
	public function endCheck($nowTime, $isTrainingPage = false)
	{
		$endTraining = $this->Model->exec('Training', 'getEndDate', $nowTime);
		
		/*
		 * MypageControllerからこの処理に入った場合はキャラの強化はしない
		 * TrainingControllerからこの処理に入った場合はキャラの強化もする
		 */
		if(isset($endTraining) && $isTrainingPage == true)
		{
			foreach( $endTraining as $val)
			{
				$trainingState = 2;
				TrainingLib::uCharaAtkUp($val['id']);
				$this->Model->exec('Training','uCharaStateChange',array($val['uCharaId'],0));
				$this->Model->exec('Training','uCoachStateChange',array($val['uCoachId'],0));
				$this->Model->exec('Training','stateChange', array($val['id'],$trainingState), $this->user['id']);
			}
		}else if(isset($endTraining) && $isTrainingPage == false){
			foreach($endTraining as $val)
			{
				$trainingState = 1;
				$this->Model->exec('Training','stateChange', array($val['id'],$trainingState), $this->user['id']);
				return $endTraining;
			}
		}
	}

	/*
	 * 
	 */
	public function uCharaAtkUp($trainingId)
	{
		//uTrainingテーブルの情報取得
		$trainingInfo = $this->Model->exec('Training','getInfo',$trainingId);
		
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

			$gooJudgeValue = rand(1, 100);
			if($gooResult <= $gooJudgeValue)
			{
				$charaGooAtk++;
				$gooUpCnt++;
			}
			$choJudgeValue = rand(1, 100);
			if($choResult <= $choJudgeValue)
			{
				$charaChoAtk++;
				$choUpCnt++;
			}
			$paaJudgeValue = rand(1, 100);
			if($paaResult <= $paaJudgeValue)
			{
				$charaPaaAtk++;
				$paaUpCnt++;
			}
			
		}
		$atkInfo = [
			'gooAtk'	=> $charaGooAtk,
			'choAtk'	=> $charaChoAtk,
			'paaAtk'	=> $charaPaaAtk,
			'gooUpCnt'	=> $gooUpCnt,
			'choUpCnt'	=> $choUpCnt,
			'paaUpCnt'	=> $paaUpCnt
		];
		$this->Model->exec('Training', 'updateAtk', array($atkInfo,$uCharaId));
	}

}