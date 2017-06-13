<?php

namespace App\Libs;

class ShopLib extends BaseGameLib
{
	// 敵の各属性を出す確率ステータスに基づいた手をランダムに選択する処理
	public static function updateItem($itemId, $itemData, $belongingsData, $user)
	{
		// name に商品のDBで使っている名前を代入
		$itemName	= $itemData[$itemId]['name'];

		// アイテムの個数を $number に代入
		$number		= $belongingsData[$itemName];

		// $number を加算
		$number++;

		// DB更新用のデータ統合
		$updateItemData['userId'] = $user['id'];
		$updateItemData['itemName'] = $itemName;
		$updateItemData['number'] = $number;
		
		return $updateItemData;
	}
}
