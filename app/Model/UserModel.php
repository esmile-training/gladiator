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
    public function createChara($userId,$uCharaId,$uCharaFirstName,$uCharaLastName,$ratio,$narrow,$hp,$atk1,$atk2,$atk3)
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
        '{$atk1}',
        '{$atk2}',
        '{$atk3}',
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
    

    public function charaStatus()
    {
$sql = <<< EOD
	UPDATE 
EOD;
    }

	
	//キャラの削除
	public function deleteChara( $uCharaId )
	{
$sql = <<< EOD
	DELETE FROM uChara
	WHERE id = {$uCharaId};
EOD;
	$this->delete($sql);
	}

	//コーチの人数検索(将来移動の可能性あり)
	public function countCoach ()
	{
$sql = <<< EOD
	SELECT COUNT( * ) 
	FROM  `uCoach` 
	WHERE userId =  {$_COOKIE['userId']};
EOD;
	$result = $this->select($sql);
	return $result;
	}
	
	//コーチの追加
	public function insertCoach ( $uCharaId, $uCharaName,$ratio, $hp, $atk1, $atk2, $atk3)
	{
$sql = <<< EOD
    INSERT INTO uCoach 
    VALUES (
    NULL,
	'{$_COOKIE['userId']}',
        '{$uCharaId}',
        '{$uCharaName}',
    '{$ratio}',
        '10',
        '{$hp}',
        '{$atk1}',
        '{$atk2}',
        '{$atk3}',
        '0'
    );
EOD;
	$this->insert($sql);
	}
	
	//コーチの削除
	public function deleteCoarch($uCoachId){
$sql = <<< EOD
	DELETE FROM uCoach
	VALUES (
	WHERE id = {$uCoachId};
EOD;
	$this->delete($sql);
	}
}