<?php

namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
	// データを表示するファンクション
	public function index()
	{
		// setData関数を呼び出し、データをセット
		$this->setData();
		
		// バトルデータがなかった場合、エラー画面を表示しホームへ戻す 
		if(is_null($this->BattleData))
		{
			return viewWrap('error');
		}
		
		// どちらかのHPが0以下になったらバトル終了フラグを立てる
		if ($this->EnemyData['bHp'] <= 0 || $this->CharaData['bHp'] <= 0)
		{
			// BattleData の 'delFlag' を立てる
			$this->BattleData['delFlag'] = 1;
		}

		// 全てのデータを viewData に渡す
		$this->viewData['BattleData']	= $this->BattleData;
		$this->viewData['CharaData']	= $this->CharaData;
		$this->viewData['EnemyData']	= $this->EnemyData;
		$this->viewData['Type']			= $this->TypeData;
		$this->viewData['Result']		= $this->ResultData;

		return viewWrap('battle', $this->viewData);
	}

	// データベースからデータをそれぞれの変数にセットするファンクション
	public function setData()
	{
		// デバッグ用　データ再セット
//		$this->debug();
		
		// config/battle で指定した三すくみの名前を読み込み
		// 'goo' 'cho' 'paa' じゃんけんの三すくみで指定中
		$this->TypeData	= \Config::get('battle.typeStr');

		// config/battle で指定した勝敗結果の名前を読み込み
		// 'win' 'lose' 'draw' で指定中
		$this->ResultData = \Config::get('battle.resultStr');

		// config/battle で指定した賞金の歩合を読み込み
		// 'Commission' で指定中 
		$this->Commission = \Config::get('battle.prizeStr');

		// config/battle で指定した賞金の割合を読み込み
		// 初級 中級 上級 で指定、数値(％)で設定中
		$this->PrizeRatio = \Config::get('battle.prizeRatio');

		// ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
		// BattleData にバトルデータを格納
		$this->BattleData = $this->Model->exec('Battle', 'getBattleData', $this->user['id']);
		
		if(isset($this->BattleData))
		{
			// バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
			// ChaaraData に自キャラデータを格納
			$this->CharaData = $this->Model->exec('Battle', 'getBattleCharaData', $this->BattleData['charaId']);

			// バトルデータを元にuBattleChar(DB)から敵データを読み込み
			// EnemyData に敵キャラデータを格納
			$this->EnemyData = $this->Model->exec('Battle', 'getBattleEnemyData', $this->BattleData['enemyId']);
		}
		
		// ユーザーIDを元に週間のランキングデータを読み込み
		$this->RankingData = $this->Model->exec('Ranking', 'getRankingData', $this->user['id']);
		if(is_null($this->RankingData))
		{
			// ランキングデータがなければ、新しくランキングデータを作成
		}
	}

	// データを更新するファンクション
	public function updateBattleData()
	{
		// setData関数を呼び出し、データをセット
		$this->setData();

		// 押されたボタンのデータを Chara の 'hand' に格納
		// 'goo' / 'cho' / 'paa' のどれかが入る
		$this->CharaData['hand'] = htmlspecialchars($_GET["sub1"], ENT_QUOTES, "UTF-8");

		// 敵キャラデータを元に、Enemy の 'hand' を格納
		// 'goo' / 'cho' / 'paa' のどれかが入る
		$this->EnemyData['hand'] = BattleLib::setEnmHand($this->EnemyData, $this->TypeData);

		// 勝敗処理
		// 'win' / 'lose' / 'draw' のどれかが入る
		$this->CharaData['result'] = BattleLib::AtackResult($this->CharaData['hand'], $this->EnemyData['hand'], $this->TypeData, $this->ResultData);

		// ダメージ処理
		// CharaData の 'result' によって処理を行う
		switch ($this->CharaData['result'])
		{
			// 'win' の場合
			case $this->ResultData['win']:
				// 自キャラデータを元にダメージ量を計算
				$this->CharaData = BattleLib::damageCalc($this->CharaData, $this->TypeData);			
				// 変動したダメージ量を元にダメージ処理後の敵キャラHPを計算
				$this->EnemyData['bHp'] = BattleLib::hpCalc($this->CharaData, $this->EnemyData, $this->TypeData);
				break;

			// 'lose' の場合
			case $this->ResultData['lose']:
				// 敵キャラデータを元にダメージ量を計算
				$this->EnemyData = BattleLib::damageCalc($this->EnemyData, $this->TypeData);					
				// 変動したダメージ量を元にダメージ処理後の自キャラHPを計算
				$this->CharaData['bHp'] = BattleLib::hpCalc($this->EnemyData, $this->CharaData, $this->TypeData);
				break;

			// 'draw' の場合
			case $this->ResultData['draw']:
				// ダメージ処理を行わず抜ける
				break;
			
			default;
				exit;
		}

		// バトルキャラデータの更新処理
		// 自キャラデータの更新処理
		$this->Model->exec('Battle', 'UpdateBattleCharaData', array($this->CharaData));
		// 敵キャラデータの更新処理
		$this->Model->exec('Battle', 'UpdateBattleEnemyData', array($this->EnemyData));

		return $this->Lib->redirect('Battle', 'index');
	}
	
	// バトルを終了するファンクション
	public function battleEnd()
	{
		// setData関数を呼び出し、データをセット
		$this->setData();

		// 賞金額用変数の初期化
		$prize = 0;

		// 敵のHPが0以下の場合(試合全体としてプレイヤーが勝った場合)
		if( $this->EnemyData['bHp'] <= 0 )
		{
			// 賞金額計算
			$prize =  BattleLib::prizeCalc($this->EnemyData, $this->Commission, $this->PrizeRatio);

			// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Money', 'addition', array($this->user, $prize));
			// ユーザーのウィークリーポイント 'weeklyAward' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Ranking', 'weeklyAdd', array($this->RankingData, $prize));
		}

		// データベースの更新処理
		// uBattleInfo の 'delFlag' を立てる処理
		$this->Model->exec('Battle', 'UpdateInfoFlag', $this->BattleData['id']);
		// uBattleChara の 'delFlag' を立てる処理
		$this->Model->exec('Battle', 'UpdateCharaFlag', $this->BattleData['id']);
		// uBattleEnemy の 'delFlag' を立てる処理
		$this->Model->exec('Battle', 'UpdateEnemyFlag', $this->BattleData['id']);


		// リザルト画面に必要なデータを viewData に渡す
		$this->viewData['Prize']		= $prize;
		$this->viewData['EnemyData']	= $this->EnemyData;

		return viewWrap('battleEnd', $this->viewData);
	}
	



	// デバッグ用ファンクション
	// uBattleInfo uBattleChara uBattleEnemy のデータを書き換える
	// 各delFlagの消去、変動値のリセット
	public function debug()
	{
		$this->Model->exec('Battle', 'debugBattleData', $this->user['id']);
		$this->BattleData = $this->Model->exec('Battle', 'getBattleData', $this->user['id']);		
		$this->Model->exec('Battle', 'debugBattleChara', $this->BattleData['charaId']);
		$this->Model->exec('Battle', 'debugBattleEnemy', $this->BattleData['enemyId']);
	}
}