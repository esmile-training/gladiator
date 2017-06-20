<?php

namespace App\Libs;

class BelongingsLib extends BaseGameLib
{
	// アイテムの更新処理
	public static function updateItem($itemId, $number, $itemData, $belongingsData, $user)
	{
		// name に商品のDBで使っている名前を代入
		$itemName	= $itemData[$itemId]['dbName'];

		// アイテムの個数を $number に代入
		$totalNumber = $belongingsData[$itemName];

		// $number を加算
		$totalNumber += $number;

		// DB更新用のデータ統合
		$updateItemData['userId']		= $user['id'];
		$updateItemData['itemName']		= $itemName;
		$updateItemData['totalNumber']	= $totalNumber;
		
		return $updateItemData;
	}
}