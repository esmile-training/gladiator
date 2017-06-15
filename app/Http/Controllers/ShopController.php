<?php
namespace App\Http\Controllers;

class ShopController extends BaseGameController
{
	/*
	 * 商品を表示するファンクション
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
	
	/*
	 * 所持アイテムや商品データを読み込むファンクション
	 */
	public function getItemData()
	{
		// 所持アイテムデータ取得
		$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		// 所持アイテムデータがなければ作成
		if(!isset($this->belongingsData))
		{
			// uItemにデータを追加
			$this->Model->exec('Item','insertItemData',$this->user['id']);
			
			// 所持アイテムデータ取得
			$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		}
		
		// アイテムデータ取得
		$this->itemData			= \Config::get('item.itemStr');

		// 商品データ取得
		$this->productData		= \Config::get('shop.productStr');
	}

	/*
	 * 所持アイテムを更新するファンクション
	 */
	public function updateBelongings()
	{
		// setData関数を呼び出し、データをセット
		$this->getItemData();

		// bladeから購入したアイテムのidを読み込み
		$purchaseItemId = $_GET["purchaseItemId"];
		
		// bladeから購入したアイテムの個数を読み込み
		$number			= $_GET["number"];
		
		// bladeから購入したアイテムの合計金額を読み込み
		$totalPrice		= $_GET["totalPrice"];

		// purchaseItemID = 1(チケット)ではない場合
		if($purchaseItemId != 1)
		{	
			// DB更新用のデータ生成
			$updateItemData = $this->Lib->exec('Belongings', 'updateItem', array($purchaseItemId, $number, $this->itemData, $this->belongingsData, $this->user));
			
			// DBの更新
			$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		}
		else
		{
			// チケットの回復
			$this->Lib->exec('Ticket', 'recoveryTicket', array($this->user, $number));
		}
		
		// ユーザーの所持金 'money' から降参費用を減算しデータベースに格納
		$this->Lib->exec('Money', 'Subtraction', array($this->user,	$totalPrice));
		
		return $this->Lib->redirect('shop', 'index');
	}
}
