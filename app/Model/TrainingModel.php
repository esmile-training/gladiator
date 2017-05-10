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
	SELECT id,imgId,name,trainingState
	FROM uCoach
	WHERE userId = '{$_COOKIE['userId']}'
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
	SELECT uCharaId, finishDate
	FROM uTraining
EOD;
	return $this->select($sql, 'all');
    }
    
    /*
     * データベースに訓練の時間と訓練中フラグを挿入
     */
    public function setFinishDate($uCharaId,$uCoachId,$trainingStartDate,$trainingFinishDate)
    {
	$trainingState = 1;
$sql =  <<< EOD
	INSERT INTO uTraining
	values(
	NULL,
	{$uCharaId},
	{$uCoachId},
	'{$trainingStartDate}',
	'{$trainingFinishDate}',
	{$trainingState}
	    );
EOD;
	$this->insert($sql);
	$this->uCharaStateChange($uCharaId,$trainingState);
    }
    
    /*
     * キャラクターが訓練しているかどうかのフラグを変更する
     */
    public function uCharaStateChange($uCharaId)
    {
$sql =  <<< EOD
	UPDATE uChara
	SET    trainingState = 0
	WHERE  id = {$uCharaId}
EOD;
	$this->update($sql);
    }
    
}