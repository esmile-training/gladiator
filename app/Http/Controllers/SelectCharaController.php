<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/27
 */

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{

	public function index()
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
		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('UChara', 'getById', $charaId);
		var_dump($selectedChara);

		// 闘技場選択にリダイレクトする
			// マイページへリダイレクトする
			$this->Lib->redirect('selectChara', 'selectArena');
	}

	/*
	 *  闘技場の選択
	 */
	public function selectArena()
	{
		// ビューへデータを渡す
			return viewWrap('arenaSelect', $this->viewData);
	}
}

