<?php
/*
 * uBattleChara用のモデル
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/02
 */

namespace App\Model;

class UBattleCharaModel extends \App\Model\BaseGameModel
{
	/*
	 *  DBからバトル用キャラデータを取得する
	 */
	public function getBattleCharaData($battleCharaId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uBattleChara
	JOIN uChara
	ON uBattleChara.charaId = uChara.id
	WHERE uBattleChara.id = {$battleCharaId}
	AND uBattleChara.delFlag = 0
EOD;

		return $this->select($sql, 'first');
	}

	/*
	 * DBにデータをインサートする
	 */
	public function InsertBattleCharaData($uCharaId,$hp,$gooAtk,$choAtk,$paaAtk)
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

	/*
	 *  'delFlag'を立てる処理
	 */
	public function UpdateCharaFlag($battleCharaId = false)
	{
$sql = <<< EOD
	UPDATE  uBattleChara
	SET		delFlag = 1
	WHERE   id = {$battleCharaId};
EOD;
		$this->update($sql);
	}

}
