<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/25
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

		// 要素ごとに切り分ける。
		$uCharaId = $selectedChara['id'];
		$hp = $selectedChara['cHp'];
		$gooAtk = $selectedChara['cGooAtk'];
		$choAtk = $selectedChara['cChoAtk'];
		$paaAtk = $selectedChara['cPaaAtk'];

		// データをDBへインサートする
		$this->Model->exec('UChara','insertChara',array($uCharaId,$hp,$gooAtk,$choAtk,$paaAtk));

		// ステージ選択(エネミー選択)へリダイレクトする
		
	}
}

