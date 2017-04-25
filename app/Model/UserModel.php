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
    
    public function getByName( $userName = false )
    {
	if( !$userName && isset($this->user['name']) ){
	    $userName = $this->user['name'];
	}

$sql =  <<< EOD
	SELECT *
	FROM user
	WHERE name = '{$userName}'
EOD;
	return $this->select($sql, 'first');
    }

    /*
    *	ユーザ作成
    */
    public function createUser($userName = null)
    {
$sql =  <<< EOD
INSERT INTO user ( `name`, `createDate` )
VALUES("{$userName}", NOW());
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