<?php
namespace App\Model;

class PresentboxModel extends BaseGameModel
{
	public function getById($userId)
	{
$sql =  <<< EOD
		SELECT *
		FROM	uPresent 
		WHERE	userId = {$userId}
		AND		delFlag = 0
		ORDER BY createDate DESC;
EOD;
		return $this->select($sql, 'all');
	}

	// プレゼントのテーブルへデータを挿入する
	public function insertPresentData($userId,$type,$objId,$imgId,$cnt = 1)
	{
		$time = date('Y-m-d H:i:s', time());
$sql =  <<< EOD
		INSERT INTO uPresent
		VALUES (
			NULL,
			0,
			{$userId},
			{$type},
			{$objId},
			{$imgId},
			'{$cnt}',
			'{$time}',
			NULL
		);
EOD;
	return $this->insert($sql);
	}
	
	public function changeDelFlag($receiveId)
	{
$sql =  <<< EOD
		UPDATE	uPresent
		SET		delFlag = 1
		WHERE	id = {$receiveId};
EOD;
		   $this->update($sql);
	}
	
	public function changeDelFlagAll($userId,$presentCharaIdMin)
	{
$sql =  <<< EOD
		UPDATE	uPresent
		SET		delFlag = 1
		WHERE	userId = $userId
		AND		type = 1
		AND		id >= $presentCharaIdMin
		AND		$presentCharaIdMin != 0
		OR		userId = $userId
		AND		type = 2
		OR		userId = $userId
		AND		type = 3;
EOD;
		$this->update($sql);
	}
}
