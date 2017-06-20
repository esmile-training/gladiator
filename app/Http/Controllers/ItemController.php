<?php
namespace App\Http\Controllers;

class ItemController extends BaseGameController
{
	/*
	 * item を使うファンクション
	 * itemId	: アイテムのID(config管理)
	 * number	: 個数
	 * ability	: 能力値(config管理)
	 * 以下itemIdによって
	 * 4(訓練短縮アイテム)
	 * charaId	: uCharaDBのキャラのID
	 */
	public function item()
	{
		// bladeからキャラの id を読み込み
		$itemId		= $_GET["itemId"];

		// bladeから使用する個数を読み込み
		$number		= $_GET["number"];

		// bladeからアイテムの能力値を読み込み
		$ability	= $_GET["ability"];

		// 訓練時間短縮アイテムのデータを item config から持ってくる
		$itemData = \Config::get('item.itemStr');

		// 所持アイテムデータ取得
		$belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		// 所持アイテムデータがなければ作成
		if(!isset($this->belongingsData))
		{
			// uItemにデータを追加
			$this->Model->exec('Item','insertItemData',$this->user['id']);
			
			// 所持アイテムデータ取得
			$belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		}

		switch ($itemId)
		{
			case 1:
			case 2:
			case 3:
			// case 4
			case 4:
				// bladeからキャラの id を読み込み
				$charaId	= $_GET["charaId"];
				
				// キャラIDから訓練データをDBから取得
				$infoData	= $this->Model->exec('Training', 'getInfoFromCharaId', $charaId);
				
				// 訓練時間短縮アイテムの処理
				$this->Lib->exec('Item', 'item4', array($infoData, $number, $ability));
				break;
			default :
				break;
		}

		// 個数をマイナスに変更
		$number *= -1;

		// DB更新用のデータ生成
		$updateItemData = $this->Lib->exec('Belongings', 'updateItem', array($itemId, $number, $itemData, $belongingsData, $this->user));

		// DBの更新
		$this->Model->exec('Item', 'updateItemData', array($updateItemData));

		//リダイレクト
		return $this->Lib->redirect('training', 'index');
	}
}
