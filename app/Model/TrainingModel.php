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
	WHERE uId = 1
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
         {
$sql =  <<< EOD
	SELECT id,uCoachId,state
	FROM uCoach
        LIMIT 3
EOD;
	return $this->select($sql, 'all');
        }
    }
    
    
    /*
     * データベースに訓練の時間と訓練中フラグを挿入
     */
    public function setFinishDate($uCharaId,$uCoachId,$trainingStartDate,$trainingFinishDate)
    {
	
$sql =  <<< EOD
	INSERT INTO uTraining
	values(
	NULL,
	{$uCharaId},
	{$uCoachId},
	'{$trainingStartDate}',
	'{$trainingFinishDate}',
	1
	    );
EOD;
	var_dump($sql);
	$this->insert($sql);
    }
}