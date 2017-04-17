<?php
namespace App\Model;

class UserModel extends BaseGameModel
{
    /*
    *	ユーザ1件取得
    */
    public static function getById( $userId  )
    {
$sql =  <<< EOD
	SELECT *
	FROM user
	WHERE id = {$userId}
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
	parent::insert($sql);
    }

    /*
    *	ユーザ削除
    */
    public static function deleteUser( $userId )
    {
	$time = date('Y-m-d H:i:s', time());
$sql =  <<< EOD
    DELETE FROM user 
    WHERE id = {$userId};
EOD;
	parent::delete($sql);
    }

    /*
    *	ユーザ名変更
    */
    public static function setUserName( $userId, $newName )
    {
	$time = date('Y-m-d H:i:s', time());
$sql =  <<< EOD
    UPDATE  user
    SET	    name = "{$newName}"
    WHERE   id = {$userId};
EOD;
	parent::update($sql);
    }
}