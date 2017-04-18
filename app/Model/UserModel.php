<?php
namespace App\Model;

class UserModel extends BaseGameModel
{
    /*
    *	ユーザ1件取得
    */
    public function getById( $userId = false )
    {
	if( !$userId && isset($this->user['id']) ){
	    $userId = $this->user['id'];
	}

$sql =  <<< EOD
	SELECT *
	FROM user
	WHERE id = {$userId}
EOD;
	return $this->select($sql, 'first');
    }
    
    
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
    
    /*
    *	chardata取得
    */
    public function getByrank( $pushbtn )
    {
	var_dump($pushbtn);
$sql =  <<< EOD
	SELECT user.id as userId,
	       upoint,
	       user.name as username
	FROM uranking 
	JOIN user ON user.id = uranking.uid 
	ORDER BY upoint DESC LIMIT 10 OFFSET $pushbtn[0];
EOD;
	return parent::select($sql, 'all');
    }

    /*
    *	ユーザ作成
    */
    public function createUser()
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
	$this->insert($sql);
    }

    /*
    *	ユーザ削除
    */
    public function deleteUser( $userId )
    {
$sql =  <<< EOD
    DELETE FROM user 
    WHERE id = {$userId};
EOD;
	$this->delete($sql);
    }

    /*
    *	ユーザ名変更
    */
    public function setUserName( $userId, $newName )
    {
$sql =  <<< EOD
    UPDATE  user
    SET	    name = "{$newName}"
    WHERE   id = {$userId};
EOD;
	$this->update($sql);
    }
}