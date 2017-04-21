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
		$userID = $this->viewData['user']['id'];
		var_dump($userID);

		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('SelectChara','getUserChara',$userID);
		// viewDataへ取得したキャラクターを送る
		$this->viewData['charaList'] = $alluChara;

		// ビューへデータを渡す
		return viewWrap('selectChara',$this->viewData);
	}

	/*
	 *  IDからキャラクターを特定する
	 */
	public function pickUpChara()
	{
		// 選択されたIDの取得をする
		$charaID = $_GET;
		var_dump($charaID);
	}
}

