<?php
namespace App\Model;

class CharDataModel extends BaseGameModel
{
    /*
    *	chardata取得
    */
    public function getByChar( $userId  )
    {
$sql =  <<< EOD
	SELECT *
	FROM uChar
	WHERE uid = {$userId}
EOD;
	return parent::select($sql, 'first');
    }
}