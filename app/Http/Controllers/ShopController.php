<?php
namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

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

		// アイテムデータ取得
		$this->itemData			= \Config::get('item.itemStr');

		// 商品データ取得
		$this->productData		= \Config::get('shop.productStr');
	}


//	// バトルデータを更新するファンクション
//	public function updateBattleData()
//	{
//		// setData関数を呼び出し、データをセット
//		$this->getBattleData();
//
//		// どちらかのHPが既に0の状態なら、ダメージ処理を行わずリザルト画面へ飛ばす
//		if($this->CharaData['battleHp'] <= 0 || $this->EnemyData['battleHp'] <= 0)
//		{
//			return $this->Lib->redirect('Battle', 'makeResultData');
//		}
//
//		// 押されたボタンのデータを Chara の 'hand' に格納
//		// 1(グー) / 2(チョキ) / 3(パー) のどれかが入る
//		$this->CharaData['hand'] = $_GET["hand"];
//
//		// 敵キャラデータを元に、Enemy の 'hand' を格納
//		// 1(グー) / 2(チョキ) / 3(パー) のどれかが入る
//		$this->EnemyData['hand'] = BattleLib::setEnmHand($this->EnemyData);
//
//		// 勝敗処理
//		// 'win' / 'lose' / 'draw' のどれかが入る
//		$this->CharaData['result'] = BattleLib::AtackResult($this->CharaData['hand'], $this->EnemyData['hand']);
//
//		// ダメージ処理
//		// CharaData の 'result' によって処理を行う
//		switch ($this->CharaData['result'])
//		{
//			// 1(勝ち) の場合
//			case 1:
//				// 自キャラデータを元にダメージ量を計算
//				$this->CharaData = BattleLib::damageCalc($this->CharaData);
//				// 変動したダメージ量を元にダメージ処理後の敵キャラHPを計算
//				$this->EnemyData['battleHp'] = BattleLib::hpCalc($this->CharaData, $this->EnemyData);
//				break;
//
//			// 2(負け) の場合
//			case 2:
//				// 敵キャラデータを元にダメージ量を計算
//				$this->EnemyData = BattleLib::damageCalc($this->EnemyData);
//				// 変動したダメージ量を元にダメージ処理後の自キャラHPを計算
//				$this->CharaData['battleHp'] = BattleLib::hpCalc($this->EnemyData, $this->CharaData);
//				break;
//
//			// 3(あいこ) の場合
//			case 3:
//				// ダメージ処理を行わず抜ける
//				break;
//
//			default;
//				exit;
//		}
//
//		// バトルキャラデータの更新処理
//		// 自キャラデータの更新処理
//		$this->Model->exec('BattleChara', 'UpdateBattleCharaData', array($this->CharaData));
//		// 敵キャラデータの更新処理
//		$this->Model->exec('BattleEnemy', 'UpdateBattleEnemyData', array($this->EnemyData));
//
//		return $this->Lib->redirect('Battle', 'battleLog');
//	}
}
