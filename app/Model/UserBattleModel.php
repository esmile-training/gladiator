<?php
namespace App\Model;

class UserBattleModel extends BaseGameModel
{
    
    // バトルデータ取得
    public function getByBattleData( $userId = false )
    {
        
$sql =  <<< EOD
	SELECT *
	FROM uBattleInfo
        WHERE uId = {$userId}
        AND Flag = 1
EOD;
        return $this->select($sql, 'first');
        
    }

    // バトル用自キャラデータ取得
    public function getByuBattleCharData( $battleCharId = false )
    {
        
//        var_dump($battleCharId);
        
$sql =  <<< EOD
	SELECT *
	FROM uBattleChar
        WHERE id = {$battleCharId}
EOD;
        return $this->select($sql, 'first');

    }
    
    // バトル用敵キャラデータ取得
    public function getByuBattleEnemyData( $battleEnemyId = false )
    {
	
$sql =  <<< EOD
	SELECT *
	FROM uBattleEnemy
        WHERE id = {$battleEnemyId}
EOD;
        return $this->select($sql, 'first');

    }
    
    // バトル用自キャラデータ更新
    public function UpdateuBattleCharData( $CharId,$CharHp )
    {
$sql =  <<< EOD
    UPDATE  uBattleChar
    SET	    Hp = {$CharHp}
    WHERE   id = {$CharId};
EOD;
	$this->update($sql);
    }

    // バトル用敵キャラデータ更新    
    public function UpdateuBattleEnemyData( $CharId,$CharHp )
    {
$sql =  <<< EOD
    UPDATE  uBattleEnemy
    SET	    Hp = {$CharHp}
    WHERE   id = {$CharId};
EOD;
	$this->update($sql);
    }
    
    // バトルフラグの更新 
    public function UpdateuBattleFlag( $BattleId )
    {
$sql =  <<< EOD
    UPDATE  uBattleInfo
    SET	    Flag = 0
    WHERE   id = {$BattleId};
EOD;
	$this->update($sql);
    }     
    
    
//    public function getByuBattleCharData()
//    {
//	
//$sql =  <<< EOD
//	SELECT  uBattleInfo.uBattleCharId,
//                uBattleChar.*
//	FROM uBattleChar JOIN uBattleInfo
//        ON uBattleChar.id = uBattleInfo.uBattleCharId
//
//EOD;
//	return $this->select($sql, 'first');
//
//    }
    
//    // バトル用敵キャラデータ取得
//    public function getByuBattleEnemyData()
//    {
//	
//$sql =  <<< EOD
//	SELECT  uBattleInfo.uBattleEnemyId,
//                uBattleEnemy.*
//	FROM uBattleEnemy JOIN uBattleInfo
//        ON uBattleEnemy.id = uBattleInfo.uBattleEnemyId      
//
//EOD;
//	return $this->select($sql, 'first');
//
//    }

//    /*
//    *	ユーザ削除
//    */
//    public function deleteUser( $userId )
//    {
//$sql =  <<< EOD
//    DELETE FROM user 
//    WHERE id = {$userId};
//EOD;
//	$this->delete($sql);
//    }
//    
}