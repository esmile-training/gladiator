<?php
namespace App\Model;

class UserModel extends BaseGameModel
{
    /*
    *	ユーザ1件取得
    */
    public static function getById( $uid  )
    {
$sql =  <<< EOD
	SELECT *
	FROM user
	WHERE id = {$uid}
EOD;
	return parent::select($sql, 'first');
    }

    /*
    *	ユーザ作成
    */
    public static function createUser()
    {
	$time = date('Y-m-d H:i:s', time());
$sql =  <<< EOD
    INSERT INTO  user 
    VALUES (
	NULL,
	'テストユーザー',
	 NULL,
	 '{$time}',
	 '{$time}'
    );
EOD;
	parent::insert($sql, 'first');
    }
    
    
}