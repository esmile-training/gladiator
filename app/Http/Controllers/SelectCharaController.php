<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/02
 */

// 名前空間の使用宣言
//namespace App\Http\Controllers;
//
//use App\Libs\BattleLib;
//
//// クラス定義
//class SelectCharaController extends BaseGameController
//{
//
//	/*
//	 *  戦うキャラの選択
//	 */
//	public function selectBattleChara()
//	{
//		// ユーザーIDを取得する
//		//$userId = 1;
//		$userId = $this->user['id'];
//		var_dump($userId);
//		// DBのキャラクターデータを取得する
//		$alluChara = $this->Model->exec('UChara', 'getUserChara', $userId);
//		// DBからキャラクターを取得できたかを確認する
//		if(!isset($alluChara))
//		{
//			// マイページへリダイレクトする
//			$this->Lib->redirect('mypage', 'index');
//		}
//		// viewDataへ取得したキャラクターを送る
//			$this->viewData['charaList'] = $alluChara;
//			// ビューへデータを渡す
//			return viewWrap('battleCharaSelect', $this->viewData);
//	}
//
//	/*
//	 *  闘技場の選択
//	 */
//	public function selectArena()
//	{
//		// ユーザーキャラクターのIDを取得する
//		$selectedCharaId = $_GET['uCharaId'];
//		// 難易度を取得する
//		$difficulty = \Config::get('arenaDifficulty','arena');
//		// 対戦の難易度とキャラIDをビューへ渡す
//		$this->viewData['difficultyList'] = $difficulty;
//		$this->viewData['selectedCharaId'] = $selectedCharaId;
//		// ビューへデータを渡す
//		return viewWrap('arenaSelect', $this->viewData);
//	}
//
//	/*
//	 *  戦闘準備(データの取得と構築)
//	 */
//	public function preparationBattle()
//	{
//		// 大会の情報を取得する(ユーザーキャラIDと難易度)
//		$arenaData = $_GET;
//		// 大会情報の取得に成功したか確認する
//		if(!isset($arenaData))
//		{
//			// マイページへリダイレクトする
//			$this->Lib->redirect('mypage', 'index');
//		}
//		// IDと一致するキャラクターをDBから取得する
//		$selectedChara = $this->Model->exec('UChara', 'getById', $arenaData["selectedCharaId"]);
//		// 正常に取得したかを確認する
//		if(!isset($selectedChara))
//		{
//			// マイページへリダイレクトする
//			$this->Lib->redirect('mypage', 'index');
//		}
//		// エネミーの外見を取得する
//		$enemyApp				= $this->Lib->exec('EnemyCreate','getEnemyAppearance');
//		// エネミーの名前を生成する
//		$enemyName				= $this->Lib->exec('EnemyCreate','creatEnemyName',[$enemyApp['sex']]);
//		// エネミー作成のための素材
//		$enemyStatusMaterial	= array($selectedChara['hp'],$arenaData["arenaDifficulty"]);
//		// エネミーの能力値を取得する
//		$enemyStatus			= $this->Lib->exec('EnemyCreate','createEnemyStatus',$enemyStatusMaterial);
//
//		$matchData = BattleLib::createMatchData($arenaData,$selectedChara,$enemyApp,$enemyName,$enemyStatus);
//		var_dump($matchData);
//
//		// 対戦データの作成をする
////		$matchData					= array();
////		// 大会難易度のを格納する
////		$matchData['difficulty']	= $arebaData["arenaDifficulty"];
////		// ユーザーキャラクターのデータを格納する
////		$matchData['uCharaId']		= $selectedChara['id'];
////		$matchData['uHp']			= $selectedChara['hp'];
////		$matchData['uGooAtk']		= $selectedChara['gooAtk'];
////		$matchData['uChoAtk']		= $selectedChara['choAtk'];
////		$matchData['uPaaAtk']		= $selectedChara['paaAtk'];
////		// エネミーのデータを格納する
////		$matchData['eImgId']			= $enemyApp['imgId'];
////		$matchData['eFirstName']	= $enemyName['firstname']['name'];
////		$matchData['eLastName']		= $enemyName['lastname']['familyname'];
////		$matchData['eHp']			= $enemyStatus['hp'];
////		$matchData['eGooAtk']		= $enemyStatus['gooAtk'];
////		$matchData['eChoAtk']		= $enemyStatus['choAtk'];
////		$matchData['ePaaAtk']		= $enemyStatus['paaAtk'];
//
//		// DBへインサートするページへリダイレクトする
//		//$this->Lib->redirect('selectChara', 'insertMatchData',$matchData);
//	}
//
//	/*
//	 * 対戦データをDBへ入れる
//	 */
//	public function insertMatchData()
//	{
//		// インフォのID
//		$infoId = null;
//		if(!isset($infoId))
//		{
//			// 対戦データの取得をする
//		$matchData = \Request::input();
//		var_dump($matchData);
//
//		// プレイヤーキャラのデータをインサートする
//		$uBattleCharaId = $this->Model->exec('UBattleChara','InsertBattleCharaData',array($matchData['uCharaId'],$matchData['uHp']
//				,$matchData['uGooAtk'],$matchData['uChoAtk'],$matchData['uPaaAtk']));
//
//		// エネミーのデータをインサートする
//		$uBattleEnemyId = $this->Model->exec('UBattleEnemy','InsertEnemyData',array($matchData['eImgId'],$matchData['difficulty']
//				,$matchData['eFirstName'],$matchData['eLastName'],$matchData['eHp'],$matchData['eGooAtk'],$matchData['eChoAtk'],$matchData['ePaaAtk']));
//
//		// ユーザーIDを取得する
//		//$userId = 1;
//		$userId = $this->user['id'];
//		// バトルインフォにデータをインサートする
//		$this->Model->exec('UBattleInfo','InsertBattleData',array($userId,$uBattleCharaId,$uBattleEnemyId));
//
//		// 戦闘待機へリダイレクトする
//		$this->Lib->redirect('selectChara', 'battleStandby');
//		}
//
//	}
//
//	/*
//		 * 戦闘開始まで待機する
//		 */
//		public function battleStandby()
//		{
//			// 対戦データの取得をする
//		$infoId = \Request::input();
//		var_dump($infoId);
//		}
//}

