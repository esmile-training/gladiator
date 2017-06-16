<?php
/*
 * uBattleChara用のモデル
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/02
 */

namespace App\Model;

class BattleCharaModel extends \App\Model\BaseGameModel
{
	/*
	 *  DBからバトル用キャラデータを取得する
	 */
	public function getBattleCharaData($battleCharaId = false)
	{
$sql = <<< EOD
	SELECT
		uBattleChara.id as uBattleCharaId,
		battleHp,
		battleGooAtk,
		battleChoAtk,
		battlePaaAtk,
		damage,
		hand,
		result,
		drawCount,
		skillFlag,
		uChara.id as uCharaId,
		userId,
		imgId,
		name,
		attribute,
		hp,
		gooAtk,
		choAtk,
		paaAtk,
		gooUpCnt,
		choUpCnt,
		paaUpCnt
	FROM uBattleChara
	LEFT JOIN uChara
	ON uBattleChara.uCharaId = uChara.id
	WHERE uBattleChara.id = {$battleCharaId}
EOD;

		return $this->select($sql, 'first');
	}

	/*
	 * DBにデータをインサートする
	 */
	public function insertBattleCharaData($uCharaId,$hp,$gooAtk,$choAtk,$paaAtk,$drawCount)
	{
		$time = date('Y-m-d H:i:s', time());
$sql = <<< EOD
		INSERT INTO uBattleChara
		VALUES (
			NULL,
			'{$uCharaId}',
			'{$hp}',
			'{$gooAtk}',
			'{$choAtk}',
			'{$paaAtk}',
			0,
			0,
			0,
			'{$drawCount}',
			0,
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
	public function UpdateBattleCharaData($battleChara)
	{

$sql = <<< EOD
	UPDATE  uBattleChara
	SET		battleHp		= '{$battleChara['battleHp']}',
			battleGooAtk = '{$battleChara['battleGooAtk']}',
			battleChoAtk = '{$battleChara['battleChoAtk']}',
			battlePaaAtk = '{$battleChara['battlePaaAtk']}',
			damage  = '{$battleChara['damage']}',
			hand	= '{$battleChara['hand']}',
			result	= '{$battleChara['result']}',
			drawCount = '{$battleChara['drawCount']}',
			skillFlag = '{$battleChara['skillFlag']}'
	WHERE	id		=  '{$battleChara['uBattleCharaId']}'
EOD;
		$this->update($sql);
	}
}