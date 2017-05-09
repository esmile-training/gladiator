<?php
/*
 * uChara用モデル
 * 作成者：松井 勇樹
 * 最終更新日：2017/04/26
 */

// 名前空間
namespace App\Model;

// クラス定義
class UCharaModel extends \App\Model\BaseGameModel
{
	/*
	 * 所持キャラクターを取得する
	 */
	public function getUserChara($userId)
	{
		// SQLに接続する
		$sql = <<< EOD
			SELECT *
			FROM uChara
			WHERE userID = {$userId}
			AND trainingState = 0
			LIMIT 10
EOD;
		return $this->select($sql);
	}

	/*
	 * IDと一致するキャラクターを取得する
	 */
	public function getById($uCharaId)
	{
		// SQLに接続する
		$sql = <<< EOD
			SELECT *
			FROM uChara
			WHERE id = {$uCharaId}
EOD;
		// 最初に一致したものを返す
		return $this->select($sql,'first');
	}

	/*
	 * キャラクターをバトル用DBへインサートする
	 */
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
		// インサートしたレコードのidを取得する
		$id = $this->insert($sql);
		// インサートしたレコードのIDを返す
		return $id;
	}
}
