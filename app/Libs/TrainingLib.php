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
		
		// MypageControllerからこの処理に入った場合はキャラの強化はしない TrainingControllerからこの処理に入った場合はキャラの強化もする
		if(isset($endTraining) && $isTrainingPage == true)
		{
			$trainingState = 2;
			TrainingLib::uCharaAtkUp(array_column($endTraining, 'id'));
			$this->Model->exec('Training','uCharaStateChange',array((int)array_column($endTraining, 'uCharaId')[0],0));
			$this->Model->exec('Training','uCoachStateChange',array((int)array_column($endTraining, 'uCoachId')[0],0));
			$this->Model->exec('Training', 'stateChange', array((int)array_column($endTraining,'id')[0], $trainingState), $this->user['id']);
			
		}else if(isset($endTraining) && $isTrainingPage == false){
			$trainingState = 1;
			$this->Model->exec('Training', 'stateChange', array((int)array_column($endTraining,'id')[0], $trainingState), $this->user['id']);
			return $endTraining;
		}
	}

	/*
	 * 訓練したキャラクターの攻撃力とコーチの攻撃力から成功確率を算出し
	 * 成功していた場合は攻撃力を上昇させる
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
		$uCharaStatus = $this->Model->exec('Training','getUCharaStatus', $uCharaId);
		foreach($uCharaStatus as $key)
		{
			$charaHp		= (int)$key['hp'];
			$charaGooAtk	= (int)$key['gooAtk'];
			$charaChoAtk	= (int)$key['choAtk'];
			$charaPaaAtk	= (int)$key['paaAtk'];
			$gooUpCnt		= (int)$key['gooUpCnt'];
			$choUpCnt		= (int)$key['choUpCnt'];
			$paaUpCnt		= (int)$key['paaUpCnt'];
		}
		
		$statusUpCnt = 0;
		//コーチのグー、チョキ、パーそれぞれの攻撃力とキャラのグー、チョキ、パーそれぞれの攻撃力から上昇率を算出
		for($i = 0; $i <= $time; $i++)
		{
			$gooResult = TrainingLib::atkUpProbability($coachGooAtk,$charaGooAtk,$gooUpCnt);
			$choResult = TrainingLib::atkUpProbability($coachChoAtk,$charaChoAtk,$choUpCnt);
			$paaResult = TrainingLib::atkUpProbability($coachPaaAtk,$charaPaaAtk,$paaUpCnt);
			
			$gooJudgeValue = rand(1, 100);
			if($gooResult >= $gooJudgeValue)
			{
				$charaGooAtk++;
				$gooUpCnt++;
				$statusUpCnt++;
			}
			$choJudgeValue = rand(1, 100);
			if($choResult >= $choJudgeValue)
			{
				$charaChoAtk++;
				$choUpCnt++;
				$statusUpCnt++;
			}
			$paaJudgeValue = rand(1, 100);
			if($paaResult >= $paaJudgeValue)
			{
				$charaPaaAtk++;
				$paaUpCnt++;
				$statusUpCnt++;
			}
		}
		
		$charaHp = $charaHp + $statusUpCnt;
		
		$statusInfo = [
			'hp'		=> $charaHp,
			'gooAtk'	=> $charaGooAtk,
			'choAtk'	=> $charaChoAtk,
			'paaAtk'	=> $charaPaaAtk,
			'gooUpCnt'	=> $gooUpCnt,
			'choUpCnt'	=> $choUpCnt,
			'paaUpCnt'	=> $paaUpCnt
		];
		$this->Model->exec('Training', 'updateStatus', array($statusInfo,$uCharaId));
	}
	
	/*
	 * 攻撃力の上昇確率の計算処理
	 */
	public function atkUpProbability($uCoachAtk,$uCharaAtk,$atkUpCnt)
	{
		$result = $uCoachAtk / $uCharaAtk * 0.5 * (100 - $atkUpCnt);
		return round($result,2);
	}

}