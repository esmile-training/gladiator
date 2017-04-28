<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/28
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
		//$uCharaId = \Request::input('id');
		$selectedCharaId = $_GET['uCharaId'];
		// 難易度を取得する
		$difficulty = \Config::get('arenaDifficulty','arena');
		//var_dump($difficulty);
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
		// キャラクターIdの取得をする
		$selectedCharaId = $_GET["selectedCharaId"];
		// 闘技場の難易度を取得する
		$arenaDifficulty = $_GET["arenaDifficulty"];

		// データの表示をする
		var_dump($selectedCharaId);
		var_dump($arenaDifficulty);
	}
}

