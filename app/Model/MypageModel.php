<?php

namespace App\Model;

class MypageModel extends BaseGameModel
{
    public function getUserData( $userId )
    {
$sql = <<< EOD
	SELECT id, name, money, battleTicket
	FROM user
	WHERE id = $userId;
EOD;
    return parent::select($sql);
    }
}

