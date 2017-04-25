<?php
/*
 * uChara用モデル
 * 作成者：松井 勇樹
 * 最終更新日：2017/04/25
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
			WHERE uId = {$userId}
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
	

}
