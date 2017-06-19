<?php
namespace App\Http\Controllers;

class ItemController extends BaseGameController
{
	/*
	 * item4(訓練時間短縮アイテム)を使うファンクション
	 */
	public function item4()
	{
		// bladeからキャラの id を読み込み
		$charaId	= $_GET["charaId"];
		
		// キャラIDから訓練データをDBから取得
		$infoData	= $this->Model->exec('Training', 'getInfoFromCharaId', $charaId);
		
		// bladeから使用する個数を読み込み
		$number		= $_GET["number"];
		
		// bladeからアイテムの短縮できる時間を読み込み
		$ability	= $_GET["ability"];
		
		// 訓練時間短縮アイテムの処理後の時間を取得
		$afterEndDate = $this->Lib->exec('Item', 'item4', array($infoData, $number, $ability));
		
		// endDate を更新
		$this->Model->exec('Training', 'updateEndDate', array($infoData['id'], $afterEndDate));
		
		//リダイレクト
		return $this->Lib->redirect('training', 'index');
	}
}
