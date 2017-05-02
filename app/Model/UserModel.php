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
    *	ユーザ作成
    */
    public function createUser($teamName = null)
    {
$sql =  <<< EOD
	INSERT INTO user ( `name`, `createDate` )
	VALUES("{$teamName}", NOW());
EOD;
	$result = $this->insert($sql);
	return $result;
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
	    //キャラの作成
    public function createChara($userId,$uCharaId,$uCharaFirstName,$uCharaLastName,$ratio,$narrow,$hp,$gu,$choki,$paa)
	{
        $sql = <<< EOD
    INSERT INTO  uChara 
    VALUES (
    NULL,
		'{$userId}',
        '{$uCharaId}',
        '{$uCharaFirstName}・{$uCharaLastName}',
		'{$ratio}',
        '{$narrow}',
        '{$hp}',
        '{$gu}',
        '{$choki}',
        '{$paa}',
		 '0',
		 '0',  
		 '0',
		'0',
        NULL,
        NULL
    );
EOD;
    return $this->insert($sql);
    }
	
	// 所持金の更新
    public function updateMoney($user)
    {
$sql = <<< EOD
	UPDATE  user
	SET		money = {$user['money']}
	WHERE   id		= {$user['id']};
EOD;
		$this->update($sql);
    }
    
    /*
    public function charaStatus()
    {
$sql = <<< EOD
	UPDATE 
EOD;
    }
     */}