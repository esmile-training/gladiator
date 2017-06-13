<?php
namespace App\Model;

class PresentBoxModel extends BaseGameModel
{
	public function confirmation($userId)
	{
$sql =  <<< EOD
		SELECT *
		FROM uPresent 
		WHERE userId = {$userId};
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
}

