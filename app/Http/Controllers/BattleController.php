<?php

namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
	// データを表示する関数
	public function index()
	{
		// setData関数を呼び出し、データをセット
		$this->setData();

		// 賞金額用変数の初期化
		$prize = 0;

		// どちらかのHPが0以下になったらバトル終了フラグを立てる
		if ($this->EnemyData['bHp'] <= 0 || $this->CharaData['bHp'] <= 0)
		{
			// 敵のHPが0以下の場合(試合全体としてプレイヤーが勝った場合)
			if( $this->EnemyData['bHp'] <= 0 )
			{
				// 賞金額計算
				$prize = ($this->EnemyData['hp'] * $this->Commission['Commission']) * ( $this->prizeRatio[$this->EnemyData['level']] * 0.01);

				// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
				$this->Lib->exec('Money', 'addition', array($this->user, $prize));
			}

			// BattleData の 'delFlag' を立てる (viewでリザルト画面への遷移判別に使用)
			$this->BattleData['delFlag'] = 1;

			// uBattleInfo の 'delFlag' を立てる処理
			$this->Model->exec('Battle', 'UpdateInfoFlag', array($this->BattleData));
			// uBattleChara の 'delFlag' を立てる処理
			$this->Model->exec('Battle', 'UpdateCharaFlag', $this->BattleData['charaId']);
			// uBattleEnemy の 'delFlag' を立てる処理
			$this->Model->exec('Battle', 'UpdateEnemyFlag', $this->BattleData['enemyId']);
		}

		// 全てのデータを viewData に渡す
		$this->viewData['Prize']		= $prize;
		$this->viewData['BattleData']	= $this->BattleData;
		$this->viewData['PcData']		= $this->CharaData;
		$this->viewData['EnmData']		= $this->EnemyData;
		$this->viewData['Type']			= $this->TypeData;
		$this->viewData['Result']		= $this->ResultData;

		return viewWrap('battle', $this->viewData);
	}

	// データベースからデータをそれぞれの変数にセットする関数
	public function setData()
	{
		// config/battle で指定した三すくみの名前を読み込み
		// 'goo' 'cho' 'paa' じゃんけんの三すくみで指定中
		$this->TypeData = \Config::get('battle.typeStr');

		// config/battle で指定した勝敗結果の名前を読み込み
		// 'win' 'lose' 'draw' で指定中
		$this->ResultData = \Config::get('battle.resultStr');

		// config/battle で指定した賞金の歩合を読み込み
		// 30 で設定中
		$this->Commission = \Config::get('battle.prizeStr');

		// config/battle で指定した賞金の割合を読み込み
		// 初級 = 1 中級 = 2 上級 = 3 に対し数値(％)を設定中
		$this->prizeRatio = \Config::get('battle.prizeRatio');

		// ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
		// BattleData にバトルデータを格納
		$this->BattleData = $this->Model->exec('Battle', 'getBattleData', $this->user['id']);

		// バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
		// ChaaraData に自キャラデータを格納
		$this->CharaData = $this->Model->exec('Battle', 'getBattleCharaData', $this->BattleData['charaId']);

		// バトルデータを元にuBattleChar(DB)から敵データを読み込み
		// EnemyData に敵キャラデータを格納
		$this->EnemyData = $this->Model->exec('Battle', 'getBattleEnemyData', $this->BattleData['enemyId']);			
	}

	// データを更新する関数
	public function updateData()
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
		$this->CharaData['result'] = BattleLib::battleResult($this->CharaData['hand'], $this->EnemyData['hand'], $this->TypeData, $this->ResultData);

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
}