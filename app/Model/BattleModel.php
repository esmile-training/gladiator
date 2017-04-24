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
        return $this->select( $sql, 'first' );
        
    }

    // バトル用自キャラデータ取得
    public function getBattleCharaData( $battleCharaId = false )
    {
	
$sql =  <<< EOD
	SELECT *
	FROM uChara
	INNER JOIN uBattleChara
        ON uBattleChara.uCharaId = uChara.id
        WHERE uBattleChara.id = {$battleCharaId}
EOD;
        return $this->select( $sql, 'first' );

    }
    
    // バトル用敵キャラデータ取得
    public function getBattleEnemyData( $battleEnemyId = false )
    {
	
$sql =  <<< EOD
	SELECT *
	FROM uBattleEnemy
        WHERE id = {$battleEnemyId}
EOD;
        return $this->select( $sql, 'first' );

    }
    
    // バトル用自キャラデータ更新    
    public function UpdateBattleCharaData( $battleChara )
    {
$sql =  <<< EOD
    UPDATE  uBattleChara
    SET	    hp = {$battleChara['hp']}
    WHERE   id = {$battleChara['id']};
EOD;
	$this->update( $sql );
    }

    // バトル用敵キャラデータ更新    
    public function UpdateBattleEnemyData( $battleEnemy )
    {
$sql =  <<< EOD
    UPDATE  uBattleEnemy
    SET	    hp = {$battleEnemy['hp']}
    WHERE   id = {$battleEnemy['id']};
EOD;
	$this->update( $sql );
    }
    
    // バトルフラグの更新 
    public function UpdateBattleFlag( $BattleId )
    {
$sql =  <<< EOD
    UPDATE  uBattleInfo
    SET	    delFlag = 1
    WHERE   id = {$BattleId};
EOD;
	$this->update( $sql );
    }     

}