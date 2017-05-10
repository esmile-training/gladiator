<?php

namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
	/*
	 * バトルスタンバイ画面を表示するファンクション
	 */
	public function index()
	{
		return view('battleStanby');
	}

	/*
	 *  戦うキャラの選択をする
	 */
	public function selectBattleChara()
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];

		// 継続中の戦闘があったらbattleLogへリダイレクトする
		$battleInfo = $this->Model->exec('BattleInfo', 'getBattleData', $userId);
		if(isset($battleInfo))
		{
			$this->Lib->redirect('battle', 'battleLog');
		}

		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('UChara', 'getUserChara', $userId);
		// DBからキャラクターを取得できたかを確認する
		if(!isset($alluChara))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
		// viewDataへ取得したキャラクターを送る
			$this->viewData['charaList'] = $alluChara;

			// ビューへデータを渡す
			return viewWrap('battleCharaSelect', $this->viewData);
	}

	/*
	 *  闘技場の選択をする
	 */
	public function selectArena()
	{
		// ユーザーキャラクターのIDを取得する
		$selectedCharaId = $_GET['uCharaId'];
		// 難易度を取得する
		$difficulty = \Config::get('battle.difficulty');
		// 対戦の難易度とキャラIDをビューへ渡す
		$this->viewData['difficultyList'] = $difficulty;
		$this->viewData['selectedCharaId'] = $selectedCharaId;

		// ビューへデータを渡す
		return viewWrap('arenaSelect', $this->viewData);
	}

	/*
	 *  戦闘準備(データの取得と構築)をする
	 */
	public function preparationBattle()
	{
		// 大会の情報を取得する(ユーザーキャラIDと難易度)
		$arenaData = $_GET;
		// 大会情報の取得に成功したか確認する
		if(!isset($arenaData))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('UChara', 'getById', $arenaData["selectedCharaId"]);
		// 正常に取得したかを確認する
		if(!isset($selectedChara))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
		// エネミーの外見を取得する
		$enemyApp				= $this->Lib->exec('EnemyCreate','getEnemyAppearance');
		// エネミーの名前を生成する
		$enemyName				= $this->Lib->exec('EnemyCreate','creatEnemyName',[$enemyApp['sex']]);
		// エネミー作成のための素材
		$enemyStatusMaterial	= array($selectedChara['hp'],$arenaData["arenaDifficulty"]);
		// エネミーの能力値を取得する
		$enemyStatus			= $this->Lib->exec('EnemyCreate','createEnemyStatus',$enemyStatusMaterial);
		// 対戦データの作成をする
		$matchData = BattleLib::createMatchData($arenaData,$selectedChara,$enemyApp,$enemyName,$enemyStatus);
		// データのインサートを行う
		$this->insertMatchData($matchData);
		// チケットの消費処理を行う
		$this->lossTicket();

		// 戦闘処理へリダイレクトする
		$this->Lib->redirect('battle', 'battleLog');
	}

	/*
	 * 対戦データをDBへ入れる
	 */
	public function insertMatchData($argMatchData)
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];
		// infoデータを取得する
		$battleInfo = $this->Model->exec('BattleInfo', 'getBattleData', $userId);
		// 対戦データの取得をする
		$matchData = $argMatchData;
		// デリートフラグが立っていない、同じIDのデータが登録されていなければインサートを行う
		if(!isset($battleInfo))
		{
			// プレイヤーキャラのデータをインサートする
			$uBattleCharaId = $this->Model->exec('BattleChara','insertBattleCharaData',array($matchData['uCharaId'],$matchData['uHp']
					,$matchData['uGooAtk'],$matchData['uChoAtk'],$matchData['uPaaAtk']));

			// エネミーのデータをインサートする
			$uBattleEnemyId = $this->Model->exec('BattleEnemy','insertEnemyData',array($matchData['eImgId'],$matchData['difficulty']
					,$matchData['eFirstName'],$matchData['eLastName'],$matchData['eHp'],$matchData['eGooAtk'],$matchData['eChoAtk'],$matchData['ePaaAtk']));

			// バトルインフォにデータをインサートする
			$this->Model->exec('BattleInfo','insertBattleData',array($userId,$uBattleCharaId,$uBattleEnemyId));

			return true;
		}
		else
		{
			// データが入っていたらfalseを返す
			return false;
		}
	}
	
	/*
	 * チケットを消費させるファンクション
	 */
	public function lossTicket()
	{
		$this->Lib->exec('Ticket','lossTicket',array($this->user,$this->nowTime));
	}

	/*
	 * バトルログを表示するファンクション
	 */
	public function battleLog()
	{
		// getData関数を呼び出し、データをセット
		$this->getBattleData();

		// バトルデータがなかった場合、処理を抜ける
		if(is_null($this->BattleData))
		{
			return view('error');
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

	/*
	 * リザルト画面を表示するファンクション
	 */
	public function battleResult()
	{
		// リダイレクト元から賞金データを取得
		$prize = filter_input(INPUT_GET,"money");

		// getRankingData ファンクションを呼び出し、ランキングデータをセット
		$this->getRankingData();
		
		// ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
		// BattleData にバトルデータを格納
		$this->BattleData = $this->Model->exec('BattleInfo', 'getBattleData', $this->user['id']);

		// リザルト画面に必要なデータを viewData に渡す
		$this->viewData['Prize']		= $prize;
		$this->viewData['RankingData']	= $this->RankingData;

		// delFlagを立てる処理
		$this->Model->exec('BattleInfo', 'UpdateInfoFlag', $this->BattleData['id']);

		return viewWrap('battleEnd', $this->viewData);
	}

	/*
	 * データベースからデータをそれぞれの変数に格納するファンクション
	 */
	public function getBattleData()
	{
		// デバッグ用　データ再セット
		// $this->debug();

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
		$this->BattleData = $this->Model->exec('BattleInfo', 'getBattleData', $this->user['id']);

		if(isset($this->BattleData))
		{
			// バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
			// ChaaraData に自キャラデータを格納
			$this->CharaData = $this->Model->exec('BattleChara', 'getBattleCharaData', $this->BattleData['uBattleCharaId']);

			// バトルデータを元にuBattleEnemy(DB)から敵データを読み込み
			// EnemyData に敵キャラデータを格納
			$this->EnemyData = $this->Model->exec('BattleEnemy', 'getBattleEnemyData', $this->BattleData['uBattleEnemyId']);
		}
	}

	/*
	 * データベースからランキングデータを RankingData に格納するファンクション
	 */
	public function getRankingData()
	{
		// ユーザーIDを元に週間のランキングデータを読み込み
		$this->RankingData = $this->Model->exec('Ranking', 'getRankingData', $this->user['id']);
		if(is_null($this->RankingData))
		{
			// ランキングデータがなければ、新しくランキングデータを作成
		}
	}

	/*
	 * バトルデータを更新するファンクション
	 */
	public function updateBattleData()
	{
		// setData関数を呼び出し、データをセット
		$this->getBattleData();

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
		$this->Model->exec('BattleChara', 'UpdateBattleCharaData', array($this->CharaData));
		// 敵キャラデータの更新処理
		$this->Model->exec('BattleEnemy', 'UpdateBattleEnemyData', array($this->EnemyData));


		return $this->Lib->redirect('Battle', 'battleLog');
	}

	/*
	 * リザルト画面に必要なデータの作成と更新をするファンクション
	 */
	public function makeResultData()
	{
		// getData ファンクションを呼び出し、バトルデータをセット
		$this->getBattleData();

		// getRankingData ファンクションを呼び出し、ランキングデータをセット
		$this->getRankingData();

		// バトルデータがなかった場合、エラー画面を表示しホームへ戻す
		// リザルト画面から戻るボタンで戻り、再度ページをリザルト画面を開かれたときの対策
		if(is_null($this->BattleData))
		{
			return view('error');
		}

		// 賞金額用変数の初期化
		$prize['money'] = 0;

		// 敵のHPが0以下の場合(試合全体としてプレイヤーが勝った場合)
		if($this->EnemyData['bHp'] <= 0)
		{
			// 賞金額計算
			$prize['money'] =  BattleLib::prizeCalc($this->EnemyData, $this->Commission, $this->PrizeRatio);

			// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Money', 'addition', array($this->user, $prize['money']));
			// ユーザーのウィークリーポイント 'weeklyAward' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Ranking', 'weeklyAdd', array($this->RankingData, $prize['money']));
		}
		// 敵のHPが0以上の場合(試合全体としてプレイヤーが負けた場合)
		else if($this->CharaData['bHp'] <= 0)
		{
			$this->Model->exec('UChara','charaDelFlag',$this->CharaData['uCharaId']);
		}

		return $this->Lib->redirect('Battle', 'battleResult',$prize);
	}
}