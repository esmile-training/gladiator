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
		public function insertChara($uCharaId,$hp,$gooAtk,$choAtk,$paaAtk)
	{
		$time = date('Y-m-d H:i:s', time());
$sql = <<< EOD
		INSERT INTO uBattleChara
		VALUES (
				NULL,
				DEFAULT,
				'{$uCharaId}',
				'{$hp}',
				'{$gooAtk}',
				'{$choAtk}',
				'{$paaAtk}',
				'未設定',
				'未設定',
				'{$time}',
				'{$time}'
		);
EOD;
		$this->insert($sql);
	}
}