<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/21
 */

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{

	public function index()
	{
		// ユーザーIDを取得する
		$userId = $this->viewData['user']['id'];
		var_dump($userId);

		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('UChara','getUserChara',$userId);
		// viewDataへ取得したキャラクターを送る
		$this->viewData['charaList'] = $alluChara;

		// ビューへデータを渡す
		return viewWrap('selectChara',$this->viewData);
	}

	/*
	 *  IDからキャラクターを特定する
	 */
	public function setChara()
	{
		// キャラクターIDの取得をする
		$charaId = $_GET['uCharaId'];

		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('UChara','getById',$charaId);

		var_dump($selectedChara);
		
		// きちんとデータを受け取れていたら、要素に切り分けてインサートする。
		// DBに該当データが無い時の処理を作る。
	}
}

