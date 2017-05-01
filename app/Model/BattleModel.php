<?php

namespace App\Model;

class BattleModel extends BaseGameModel {

	// uBattleInfo DBからバトルデータ取得
	public function getBattleData($userId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uBattleInfo
	WHERE userId	= {$userId}
	AND delFlag		= 0
EOD;
		return $this->select($sql, 'first');
	}

	// uBattleChara DBからバトル用自キャラデータ取得
	public function getBattleCharaData($battleCharaId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uBattleChara
	JOIN uChara
	ON uBattleChara.charaId		= uChara.id
	WHERE uBattleChara.id		= {$battleCharaId}
	AND uBattleChara.delFlag	= 0

EOD;
		return $this->select($sql, 'first');
	}

	// uBattleEnemy DBからバトル用敵キャラデータ取得
	public function getBattleEnemyData($battleEnemyId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uBattleEnemy
	WHERE id = {$battleEnemyId}
	AND uBattleEnemy.delFlag	= 0	

EOD;
		return $this->select($sql, 'first');
	}

	// uBattleChara DBの更新処理    
	public function UpdateBattleCharaData($battleChara)
	{
$sql = <<< EOD
	UPDATE  uBattleChara
	SET		bHp		= {$battleChara['bHp']},
			bGooAtk = {$battleChara['bGooAtk']},
			bChoAtk = {$battleChara['bChoAtk']},
			bPaaAtk = {$battleChara['bPaaAtk']},
			hand	= '{$battleChara['hand']}',
			result	= '{$battleChara['result']}'
	WHERE   id		= {$battleChara['id']};
EOD;
		$this->update($sql);
	}

	// uBattleEnemy DBの更新処理
	public function UpdateBattleEnemyData($battleEnemy)
	{
$sql = <<< EOD
	UPDATE  uBattleEnemy
	SET		bHp		= {$battleEnemy['bHp']},
			bGooAtk = {$battleEnemy['bGooAtk']},
			bChoAtk = {$battleEnemy['bChoAtk']},
			bPaaAtk = {$battleEnemy['bPaaAtk']},
			hand	= '{$battleEnemy['hand']}'
	WHERE   id		= {$battleEnemy['id']};
EOD;
		$this->update($sql);
	}

	// uBattleInfo の 'delFlag' を立てる処理
	public function UpdateInfoFlag($battleDataId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleInfo
	SET		delFlag = 1
	WHERE   id		= {$battleDataId};
EOD;
		$this->update($sql);
	}

	// uBattleInfo の 'delFlag' を立てる処理
	public function UpdateCharaFlag($battleCharaId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleChara
	SET		delFlag = 1
	WHERE   id		= {$battleCharaId};
EOD;
		$this->update($sql);
	}

	// uBattleInfo の 'delFlag' を立てる処理
	public function UpdateEnemyFlag($battleEnemyId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleEnemy
	SET		delFlag = 1
	WHERE   id		= {$battleEnemyId};
EOD;
		$this->update($sql);
	}
	
	
	
	
	
	
	public function debugBattleData($battleDataId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleInfo
	SET		delFlag = 0
	WHERE   id		= {$battleDataId};
EOD;
		$this->update($sql);
	}
	public function debugBattleChara($battleCharaId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleChara
	SET		bHp		= 100000,
			delFlag	= 0,
			hand	= '未設定',
			result	= '未設定'
	WHERE   id		= {$battleCharaId};
EOD;
		$this->update($sql);
	}
	public function debugBattleEnemy($battleEnemyId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleEnemy
	SET		bHp		= 10,
			delFlag	= 0,
			hand	= '未設定'
	WHERE   id		= {$battleEnemyId};
EOD;
		$this->update($sql);
	}	
}
