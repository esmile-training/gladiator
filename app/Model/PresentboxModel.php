<?php
namespace App\Model;

class PresentBoxModel extends BaseGameModel
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
	
	public function insertPresentData($userId,$type,$objId,$imgId,$time,$cnt = 1)
	{
$sql =  <<< EOD
		INSERT INTO uPresent
		values(
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
}

