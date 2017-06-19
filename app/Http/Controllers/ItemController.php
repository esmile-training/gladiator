<?php
namespace App\Http\Controllers;

class ItemController extends BaseGameController
{
	/*
	 * item4(訓練時間短縮アイテム)を使うファンクション
	 */
	public function item4()
	{
		$this->Lib->exec('Item', 'updateItem', array($purchaseItemId, $number, $this->itemData, $this->belongingsData, $this->user));

		//リダイレクト
		return $this->Lib->redirect('training', 'index');

	}
}
