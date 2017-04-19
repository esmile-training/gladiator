<?php
/*
 * キャラ選択コントローラー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/18
 */

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharacterController extends BaseGameController
{

	public function index()
	{
		// キャラクターコンフィグの取得をする
		$characterConfig = \Config::get('character.uCharacter');
		// キャラクターデータをviewDataに格納する
		$this->viewData['characterList'] = $characterConfig;
		// ビューへデータを渡す
		return viewWrap('selectCharacter',$this->viewData);
	}

	// IDからキャラクターを特定する
	public function pickUpCharacter()
	{
		// 選択されたIDの取得をする
		$characterID = $_POST;
		var_dump($characterID);
	}
}

