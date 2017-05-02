<?php
namespace App\Model;

class TrainingModel extends BaseGameModel
{
    /*
     * データベースからキャラの情報取得
     */
    public function getUserChara()
    {
$sql =  <<< EOD
	SELECT *
	FROM uChara
	WHERE userId = 1
	AND trainingState = 0
        LIMIT 10
EOD;
        $result = $this->select($sql, 'all');
	return $result;
    }

    /*
     * データベースからコーチの情報取得
     */
    public function getUserCoach()
    {
$sql =  <<< EOD
	SELECT *
	FROM uCoach
        LIMIT 3
EOD;
	return $this->select($sql, 'all');
    }

    /*
     * トレーニングの終了時刻を取得
     */
    public function getTrainingDate()
    {
$sql =  <<< EOD
	SELECT id, uCharaId, finishDate, time
	FROM uTraining
EOD;
	return $this->select($sql, 'all');
    }

    /*
     * データベースに訓練の時間と訓練中フラグを挿入
     */
    public function setFinishDate($trainingData)
    {
	$trainingState = 1;
$sql =  <<< EOD
	INSERT INTO uTraining
	values(
	NULL,
	{$trainingData['uCharaId']},
	{$trainingData['uCoachId']},
	'{$trainingData['trainingStartDate']}',
	'{$trainingData['trainingFinishDate']}',
	{$trainingData['trainingTime']},
	{$trainingState}
	    );
EOD;
	$this->insert($sql);
	$this->uCharaStateChange($trainingData['uCharaId'],$trainingState);
    }

    /*
     * キャラクターが訓練しているかどうかのフラグを変更する
     */
    public function uCharaStateChange($uCharaId,$trainingState)
    {

$sql =  <<< EOD
	UPDATE uChara
	SET    trainingState = {$trainingState}
	WHERE  id = {$uCharaId};
EOD;
	$this->update($sql);
    }
	
	public function getTrainingInfo($id)
    {
$sql =  <<< EOD
	SELECT uCharaId,uCoachId,time
	FROM uTraining
	WHERE id = {$id};
EOD;
        $result = $this->select($sql, 'all');
		return $result;
    }
	
	public function getUCharaAtk($uCharaId)
    {
$sql =  <<< EOD
	SELECT gooAtk,choAtk,paaAtk,gooUpCnt,choUpCnt,paaUpCnt
	FROM uChara
	WHERE id = {$uCharaId};
EOD;
        $result = $this->select($sql, 'all');
		return $result;
    }
	
	public function getUCoachAtk($uCoachId)
    {
$sql =  <<< EOD
	SELECT gooAtk,choAtk,paaAtk
	FROM uCoach
	WHERE id = {$uCoachId};
EOD;
        $result = $this->select($sql, 'all');
		return $result;
    }
	
	public function updateAtk($gooAtk,$choAtk,$paaAtk,$uCharaId)
	{
$sql =  <<< EOD
		UPDATE uChara
		SET    gooAtk = {$gooAtk},
			   choAtk = {$choAtk},
			   paaAtk = {$paaAtk}
		WHERE  id = {$uCharaId};
EOD;
		$this->update($sql);
	}
}