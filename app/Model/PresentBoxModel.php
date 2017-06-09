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
}

