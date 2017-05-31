<?php

namespace App\Model;

class MypageModel extends BaseGameModel
{
    public function getUserData( $userId )
    {
$sql = <<< EOD
	SELECT userId, user.name, user.money, user.battleTicket, uChara.hp, uChara.imgId
	FROM uChara
	LEFT outer JOIN user
	ON userId = user.id
	WHERE userId = $userId 
	ORDER BY uChara.hp DESC LIMIT 1
EOD;
    return parent::select($sql, 'first');
    }
	
	public function delFlagCheck($userId)
	{
$sql = <<< EOD
	SELECT COUNT(*) as count
	FROM uChara
	WHERE userId = $userId AND delFlag = 0;
EOD;
    return parent::select($sql, 'first');
	}
}

