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
}

