<?php
namespace App\Http\Controllers;

// Lib
use App\Libs\MoneyLib;

class ShopController extends BaseGameController
{
	/*
	 * ショップを表示するファンクション
	 */
	public function index()
	{
		// setData関数を呼び出し、データをセット
		$this->getItemData();

		// 全てのデータを viewData に渡す
		$this->viewData['userData']			= $this->user;
		$this->viewData['ticketData']		= $this->Ticket;
		$this->viewData['belongingsData']	= $this->belongingsData;
		$this->viewData['itemData']			= $this->itemData;
		$this->viewData['productData']		= $this->productData;

		return viewWrap('shop', $this->viewData);
	}

	public function getItemData()
	{
		// 所持アイテムデータ取得
		$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		// 所持アイテムデータがなければ作成
		if(!isset($this->belongingsData)){
			// uItemにデータを追加
			$this->Model->exec('Item','insertItemData',$this->user['id']);
		}
		
		// アイテムデータ取得
		$this->itemData			= \Config::get('item.itemStr');

		// 商品データ取得
		$this->productData		= \Config::get('shop.productStr');
	}

	public function updateBelongings()
	{
		// setData関数を呼び出し、データをセット
		$this->getItemData();

		// bladeから購入したアイテムのidを読み込み
		$purchaseItemId = $_GET["purchaseItemId"];
		
		// bladeから購入したアイテムの合計金額を読み込み
		$totalPrice		= $_GET["totalPrice"];

		// purchaseItemID = 1(チケット)ではない場合
		if($purchaseItemId != 1){
			// name に商品のDBで使っている名前を代入
			$itemName			= $this->itemData[$purchaseItemId]['name'];

			// アイテムの個数を $belongingsData に代入
			$belongingsData = $this->belongingsData[$itemName];

			// $belongingsData を加算
			$belongingsData++;
			
			// ユーザーの所持金 'money' から降参費用を減算しデータベースに格納
			$this->Lib->exec('Money', 'Subtraction', array($this->user,	$totalPrice));

			// DB更新用のデータ統合
			$updateItemData['userId'] = $this->user['id'];
			$updateItemData['itemName'] = $itemName;
			$updateItemData['belongingsData'] = $belongingsData;

			// DBの更新
			$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		}else{
			// チケットの回復
			$this->Lib->exec('Ticket', 'recoveryTicket', array($this->user));

			// ユーザーの所持金 'money' から降参費用を減算しデータベースに格納
			$this->Lib->exec('Money', 'Subtraction', array($this->user,	$totalPrice));

		}
		return $this->Lib->redirect('shop', 'index');
	}
}
