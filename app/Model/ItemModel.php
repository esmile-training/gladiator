<?php

namespace App\Model;

class ItemModel extends BaseGameModel
{
	/*
	 * データベースに登録
	 */
	public function insertItemData( $userId )
	{
$sql = <<< EOD
	INSERT INTO uItem(userId)
	VALUES	($userId);
EOD;
	return parent::insert($sql);
	}

	/*
	 * DBから所持アイテムデータを取得する
	 */
	public function getItemData($userId = false)
	{
$sql = <<< EOD
	SELECT *
	FROM uItem
	WHERE userId = {$userId}
EOD;
	return $this->select($sql, 'first');
	}
}

