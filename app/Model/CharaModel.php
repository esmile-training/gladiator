<?php
/*
 * uChara用モデル
 * 作成者：松井 勇樹
 * 最終更新日：2017/04/26
 */

// 名前空間
namespace App\Model;

// クラス定義
class CharaModel extends \App\Model\BaseGameModel
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
			AND delFlag = 0
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
	 * キャラクターのdelFlagを立てる
	 */
	public function charaDelFlag($uCharaId)
	{
$sql = <<< EOD
	UPDATE  uChara
	SET		delFlag = 1
	WHERE   id = {$uCharaId};
EOD;
		$this->update($sql);
	}

	/*
	 * 所持キャラクター一覧表示用sql(追加者:吉田)
	 */
	public function getAllUserChara($userId)
		{
			// SQLに接続する
$sql = <<< EOD
				SELECT *
				FROM uChara
				WHERE userID = {$userId}
				AND delFlag = 0
EOD;
			return $this->select($sql);
		}
}
