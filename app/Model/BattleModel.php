<?php
namespace App\Model;

class BattleModel extends BaseGameModel
{
    
    // バトルデータ取得
    public function getBattleData( $userId = false )
    {
        
$sql =  <<< EOD
	SELECT *
	FROM uBattleInfo
        WHERE uId = {$userId}
        AND delFlag = 0
EOD;
        return $this->select($sql, 'first');
        
    }

    // バトル用自キャラデータ取得
    public function getBattleCharaData( $battleCharaId = false )
    {
        
$sql =  <<< EOD
	SELECT *
	FROM uBattleChara
        WHERE id = {$battleCharaId}
EOD;
        return $this->select($sql, 'first');

    }
    
    // バトル用敵キャラデータ取得
    public function getBattleEnemyData( $battleEnemyId = false )
    {
	
$sql =  <<< EOD
	SELECT *
	FROM uBattleEnemy
        WHERE id = {$battleEnemyId}
EOD;
        return $this->select($sql, 'first');

    }
    
    // バトル用自キャラデータ更新
    public function UpdateBattleCharData( $battleCharaId,$battleCharaHp )
    {
$sql =  <<< EOD
    UPDATE  uBattleChara
    SET	    hp = {$battleCharaHp}
    WHERE   id = {$battleCharaId};
EOD;
	$this->update($sql);
    }

    // バトル用敵キャラデータ更新    
    public function UpdateBattleEnemyData( $battleEnemyId,$battleEnemyHp )
    {
$sql =  <<< EOD
    UPDATE  uBattleEnemy
    SET	    hp = {$battleEnemyHp}
    WHERE   id = {$battleEnemyId};
EOD;
	$this->update($sql);
    }
    
    // バトルフラグの更新 
    public function UpdateBattleFlag( $BattleId )
    {
$sql =  <<< EOD
    UPDATE  uBattleInfo
    SET	    delFlag = 1
    WHERE   id = {$BattleId};
EOD;
	$this->update($sql);
    }     

}