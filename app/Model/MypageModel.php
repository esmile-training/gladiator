<?php

namespace App\Model;

class MypageModel extends BaseGameModel
{	
	public function delFlagCheck($userId)
	{
$sql = <<< EOD
	SELECT imgId
	FROM uChara
	WHERE userId = $userId AND delFlag = 0
	ORDER BY hp DESC LIMIT 1;
EOD;
    return parent::select($sql, 'first');
	}
}

