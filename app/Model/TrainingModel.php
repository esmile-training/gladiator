<?php
namespace App\Model;

class TrainingModel extends BaseGameModel
{
	/*
	 * データベースからコーチの情報取得
	 */
	public function getUserCoach($userId)
	{
$sql =  <<< EOD
		SELECT *
		FROM	uCoach
		WHERE	userId = $userId
		AND		state != 2
		LIMIT 3
EOD;
		return $this->select($sql, 'all');
	}

	/*
	 * データベースに訓練の時間と訓練中フラグを挿入
	 */
	public function setEndDate($trainingData,$userId)
	{
$sql =  <<< EOD
		INSERT INTO uTraining
		values(
			NULL,
			{$userId},
			{$trainingData['uCharaId']},
			{$trainingData['uCoachId']},
			'{$trainingData['trainingStartDate']}',
			'{$trainingData['trainingEndDate']}',
			{$trainingData['trainingTime']},
			0
		);
EOD;
	return $this->insert($sql);
	}
	
	public function getInfo($id)
	{
$sql =  <<< EOD
		SELECT	uCharaId,uCoachId,time
		FROM	uTraining
		WHERE	id = {$id}
EOD;
		$result = $this->select($sql, 'first');
		return $result;
	}

	/*
	 * 訓練終了時刻を過ぎている訓練のデータを取得
	 */
	public function getEndDate($nowTime,$userId)
	{
$sql =  <<< EOD
		SELECT	id, uCharaId, uCoachId, endDate
		FROM	uTraining
		WHERE	userId		 = {$userId} 
		AND		endDate		<= '{$nowTime}'
		AND		state		!= 2;
EOD;
		return $this->select($sql, 'all');
	}

	/*
	 * キャラクターの攻撃力を取得
	 */
	public function getUCharaStatus($uCharaId)
	{
$sql =  <<< EOD
		SELECT hp,gooAtk,choAtk,paaAtk,gooUpCnt,choUpCnt,paaUpCnt
		FROM uChara
		WHERE id = {$uCharaId};
EOD;
		$result = $this->select($sql, 'first');
		return $result;
	}
	
	/*
	 * コーチの攻撃力を取得
	 */
	public function getUCoachAtk($uCoachId)
	{
$sql =  <<< EOD
		SELECT	gooAtk,choAtk,paaAtk
		FROM	uCoach
		WHERE	id = {$uCoachId}
EOD;
		$result = $this->select($sql, 'first');
		return $result;
	}
	
	/*
	 * キャラクターの訓練状態を変更する
	 */
	public function uCharaStateChange($uCharaId,$trainingState)
	{
$sql =  <<< EOD
		UPDATE  uChara
		SET		trainingState = {$trainingState}
		WHERE	id = {$uCharaId}
EOD;
	$this->update($sql);
	}
	
	/*
	 * コーチの訓練状態を変更する
	 */
	public function uCoachStateChange($uCoachId,$trainingState)
	{
$sql =  <<< EOD
		UPDATE  uCoach
		SET		state = {$trainingState}
		WHERE	id = {$uCoachId}
EOD;
	$this->update($sql);
	}
	
	 /*
	 * 訓練の状態を変更する
	 * 0なら訓練中、1なら訓練終了かつ訓練結果未確認、2なら訓練終了かつ結果確認済み
	 */
	public function stateChange($id,$trainingState)
	{	
$sql =  <<< EOD
		UPDATE uTraining
		SET    state = {$trainingState}
		WHERE  id = {$id};
EOD;
		$this->update($sql);
	}
	
	/*
	 * 訓練終了したキャラ数
	 */
	public function endAlert($userId)
	{
$sql =  <<< EOD
		SELECT COUNT(*) as count 
		FROM uTraining 
		WHERE userId = {$userId} AND state = 1;
EOD;
		return $this->select($sql, 'first');
	}
}