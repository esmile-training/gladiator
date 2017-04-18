<?php
namespace App\Model;

class BattleModel extends BaseGameModel
{

    // キャラの取得
    public static function getByPEData()
    {
$sql =  <<< EOD
	SELECT *
	FROM battle
	WHERE PE = {$PE}
EOD;
	return parent::select($sql, 'first');
    }

    // ログデータの削除
    public static function deleteData( $PE )
    {
$sql =  <<< EOD
    DELETE FROM battle
    WHERE PE = {$PE};
EOD;
	parent::delete($PE);
    }

}