<?php
/*
 * uBattleEnemy用のモデル
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/02
 */

namespace App\Model;

class BattleEnemyModel extends \App\Model\BaseGameModel
{
	/*
	 * DBから敵データを取得する
	 */
	public function getBattleEnemyData($battleEnemyId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uBattleEnemy
	WHERE id = {$battleEnemyId}
EOD;

		return $this->select($sql, 'first');
	}

	/*
	 * DBにデータをインサートする
	 */
	public function insertEnemyData($imgId,$difficulty,$firstName,$lastName,$hp,$gooAtk,$choAtk,$paaAtk)
	{
		$time = date('Y-m-d H:i:s', time());
$sql = <<< EOD
		INSERT INTO uBattleEnemy
		VALUES (
			NULL,
			'{$imgId}',
			'{$difficulty}',
			'{$firstName}・{$lastName}',
			'{$hp}',
			'{$gooAtk}',
			'{$choAtk}',
			'{$paaAtk}',
			'0',
			'33',
			'33',
			'33',
			'未設定',
			'{$hp}',
			'{$gooAtk}',
			'{$choAtk}',
			'{$paaAtk}',
			'{$time}',
			'{$time}'
		);
EOD;
		// インサートしたレコードのidを取得する
		$id = $this->insert($sql);
		// インサートしたレコードのIDを返す
		return $id;
	}

	/*
	 * DBの更新をする
	 */
	public function UpdateBattleEnemyData($battleEnemy)
	{
$sql = <<< EOD
	UPDATE  uBattleEnemy
	SET		battleHp		= {$battleEnemy['battleHp']},
			battleGooAtk = {$battleEnemy['battleGooAtk']},
			battleChoAtk = {$battleEnemy['battleChoAtk']},
			battlePaaAtk = {$battleEnemy['battlePaaAtk']},
			damage	= {$battleEnemy['damage']},
			hand	= '{$battleEnemy['hand']}'
	WHERE   id		= {$battleEnemy['id']};
EOD;
		$this->update($sql);
	}

}