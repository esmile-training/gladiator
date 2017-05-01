<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/01
 */

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{

	/*
	 *  戦うキャラの選択
	 */
	public function selectBattleChara()
	{
		// ユーザーIDを取得する
		$userId = 1;//$this->user['id'];
		var_dump($userId);
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
	 *  IDからキャラクターを特定する
	 */
	public function identifyChara()
	{
		// キャラクターIDの取得をする
		$charaId = $_GET['uCharaId'];
		// データ取得に成功したか確認する
		if(!isset($charaId))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
//		// IDと一致するキャラクターをDBから取得する
//		$selectedChara = $this->Model->exec('UChara', 'getById', $charaId);
//		// 正常に取得したかを確認する
//		if(!isset($selectedChara))
//		{
//			// マイページへリダイレクトする
//			$this->Lib->redirect('mypage', 'index');
//		}
		$selectedChara = array('id'=>$charaId);
		// 闘技場選択にリダイレクトする
		$this->Lib->redirect('selectChara', 'selectArena',$selectedChara);
	}

	/*
	 *  闘技場の選択
	 */
	public function selectArena()
	{
		// ユーザーキャラクターのIDを取得する
		$selectedCharaId = $_GET['uCharaId'];
		// 難易度を取得する
		$difficulty = \Config::get('arenaDifficulty','arena');
		// 対戦の難易度とキャラIDをビューへ渡す
		$this->viewData['difficultyList'] = $difficulty;
		$this->viewData['selectedCharaId'] = $selectedCharaId;
		// ビューへデータを渡す
		return viewWrap('arenaSelect', $this->viewData);
	}

	/*
	 *  戦闘準備(データの取得と構築)
	 */
	public function preparationBattle()
	{
		// 大会の情報を取得する(ユーザーキャラIDと難易度)
		$arebaData = $_GET;
		// 大会情報の取得に成功したか確認する
		if(!isset($arebaData))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('UChara', 'getById', $arebaData["selectedCharaId"]);
		// 正常に取得したかを確認する
		if(!isset($selectedChara))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}
		// エネミーの外見を取得する
		$enemyApp = $this->Lib->exec('EnemyCreate','getEnemyAppearance');
		// エネミーの名前を生成する
		$enemyName = $this->Lib->exec('EnemyCreate','creatEnemyName',[$enemyApp['sex']]);
		// エネミー作成のための素材
		$enemyStatusMaterial = array($selectedChara['hp'],$arebaData["arenaDifficulty"]);
		// エネミーの能力値を取得する
		$enemyStatus = $this->Lib->exec('EnemyCreate','createEnemyStatus',$enemyStatusMaterial);
		// 対戦データの作成をする
		$matchData = array();
		// 大会難易度のを格納する
		$matchData['difficulty'] = $arebaData["arenaDifficulty"];
		// ユーザーキャラクターのデータを格納する
		$matchData['uCharaId']	= $selectedChara['id'];
		$matchData['uHp']		= $selectedChara['hp'];
		$matchData['uGooAtk']	= $selectedChara['gooAtk'];
		$matchData['uChoAtk']	= $selectedChara['choAtk'];
		$matchData['uPaaAtk']	= $selectedChara['paaAtk'];
		// エネミーのデータを格納する
		$matchData['eFirstName']	= $enemyName['firstname']['name'];
		$matchData['eLastName']		= $enemyName['lastname']['familyname'];
		$matchData['eHp']			= $enemyStatus['hp'];
		$matchData['eGooAtk']		= $enemyStatus['gooAtk'];
		$matchData['eChoAtk']		= $enemyStatus['choAtk'];
		$matchData['ePaaAtk']		= $enemyStatus['paaAtk'];

		var_dump($matchData);

		// DBへインサートするページへリダイレクトする
		$this->Lib->redirect('selectChara', 'insertMatchData',$matchData);
	}

	/*
	 * 対戦データをDBへ入れる
	 */
	public function insertMatchData()
	{
		
	}
}

