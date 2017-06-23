<?php
namespace App\Http\Controllers;

class ItemController extends BaseGameController
{
	/*
	 * item を使うファンクション
	 * itemId	: アイテムのID(config管理)
	 * number	: 個数
	 * 
	 * 以下itemIdによって
	 * 2、3(バトル中アイテム)
	 * battleCharaId : uBattleCharaDBのキャラのID
	 * 
	 * 4(訓練短縮アイテム)
	 * charaId	: uCharaDBのキャラのID
	 */
	public function item()
	{
		// bladeからアイテムの id を読み込み
		$itemId		= $_GET["itemId"];

		// bladeから使用する個数を読み込み
		$number		= $_GET["number"];

		// 訓練時間短縮アイテムのデータを item config から持ってくる
		$itemData	= \Config::get('item.itemStr');

		// 所持アイテムデータ取得
		$belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		// 所持アイテムデータがなければ作成
		if(!isset($belongingsData))
		{
			// uItemにデータを追加
			$this->Model->exec('Item','insertItemData',$this->user['id']);

			// 所持アイテムデータ取得
			$belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		}

		// 個数をマイナスに変更
		$number *= -1;

		// DB更新用のデータ生成
		$updateItemData = $this->Lib->exec('Belongings', 'updateItem', array($itemId, $number, $itemData, $belongingsData, $this->user));

		// DBの更新
		$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		
		switch ($itemId)
		{
			// チケットが該当するので使用なし
			case 1:
				break;
			// バトル中HP回復アイテム(2)の場合
			case 2:
				// bladeからバトルキャラのIDを読み込み
				$battleCharaId		=  $_GET["battleCharaId"];

				// バトルキャラのIDを元にバトルキャラのデータを取得
				$battleCharaData	= $this->Model->exec('BattleChara', 'getBattleCharaData', $battleCharaId);

				// result を 回復アイテム使用時(5)に指定
				$battleCharaData['result']	= 5;

				// バトル中HP回復アイテムの処理
				$battleCharaData['battleHp'] = $this->Lib->exec('Item', 'item2', array($battleCharaData, $itemData[$itemId]['ability']));

				// 自キャラデータの更新処理
				$this->Model->exec('BattleChara', 'UpdateBattleCharaData', array($battleCharaData));

				//リダイレクト
				return $this->Lib->redirect('battle', 'battleLog');

			// バトル中攻撃力上昇アイテム(3)の場合
			case 3:
				// bladeからバトルキャラのIDを読み込み
				$battleCharaId		=  $_GET["battleCharaId"];

				// バトルキャラのIDを元にバトルキャラのデータを取得
				$battleCharaData	= $this->Model->exec('BattleChara', 'getBattleCharaData', $battleCharaId);

				// result を 攻撃力上昇アイテム使用時(6)に指定
				$battleCharaData['result']	= 6;

				// キャラの属性によって上昇させる攻撃を変更
				switch($battleCharaData['attribute'])
				{
					case 1:
						// 攻撃力上昇処理
						$battleCharaData['battleGooAtk'] = $this->Lib->exec('Item', 'item3', array($battleCharaData['battleGooAtk'], $itemData[$itemId]['ability']));
						break;
					case 2:
						// 攻撃力上昇処理
						$battleCharaData['battleChoAtk'] = $this->Lib->exec('Item', 'item3', array($battleCharaData['battleChoAtk'], $itemData[$itemId]['ability']));
						break;
					case 3:
						// 攻撃力上昇処理
						$battleCharaData['battlePaaAtk'] = $this->Lib->exec('Item', 'item3', array($battleCharaData['battlePaaAtk'], $itemData[$itemId]['ability']));
						break;
					default;
						exit;
				}

				// 自キャラデータの更新処理
				$this->Model->exec('BattleChara', 'UpdateBattleCharaData', array($battleCharaData));

				//リダイレクト
				return $this->Lib->redirect('battle', 'battleLog');

			// 訓練時間短縮アイテム(4)の場合
			case 4:
				// bladeからキャラの id を読み込み
				$charaId	= $_GET["charaId"];

				// キャラIDから訓練データをDBから取得
				$infoData	= $this->Model->exec('Training', 'getInfoFromCharaId', $charaId);

				// 訓練時間短縮アイテムの処理
				$infoData['endDate'] = $this->Lib->exec('Item', 'item4', array($infoData, $number, $itemData[$itemId]['ability']));
				
				// uTraing の endDate を更新
				$this->Model->exec('Training', 'updateEndDate', array($infoData['id'],$infoData['endDate']));

				//リダイレクト
				return $this->Lib->redirect('training', 'index');

			default :
				break;
		}
	}
}
