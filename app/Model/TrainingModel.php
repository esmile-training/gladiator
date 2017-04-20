<?php
namespace App\Model;

class TrainingModel extends BaseGameModel
{
     /*
     * データベースからキャラの情報取得
     */
    public function getUChara()
    {
$sql =  <<< EOD
	SELECT *
	FROM uChar
	WHERE uid = 2
        LIMIT 10
EOD;
        $result = $this->select($sql, 'all');
	return $result;
    }
    
    /*
     * データベースからコーチの情報取得
     */
    public function getUCoach()
    {
         {
$sql =  <<< EOD
	SELECT cname,cattr,chp,catk1,catk2,catk3
	FROM uChar
        LIMIT 3
EOD;
	return $this->select($sql, 'all');
        }
    }
    
    
    /*
     * データベースに訓練の時間と訓練中フラグを挿入
     */
    public function setTime($userId,$charId)
    {
	$time = date('Y-m-d H:i:s', time());
	$testTime = $time('Y-m-d H:i+30:s', time());
	
	$sql =  <<< EOD
	INSERT INTO training
	values(
	NULL,
	{$userId},
	{$charId},
	'{$time}',
	'{$testTime}',
	1
	    );
EOD;
	$this->insert($sql);
    }
}