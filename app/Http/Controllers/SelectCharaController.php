<?php

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{

	public function index()
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];
		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('Chara','getUserChara',$userId);

		// DBからキャラクターを取得できたかを確認する
		if(isset($alluChara))
		{
			// viewDataへ取得したキャラクターを送る
			$this->viewData['charaList'] = $alluChara;
			// ビューへデータを渡す
			return viewWrap('selectChara',$this->viewData);
		}
		else
		{
			$this->viewData['charaList'] = null;
			// キャラクターのデータが無ければ、マイページへリダイレクトする
			return viewWrap('selectChara',$this->viewData);
			//$this->Lib->redirect('mypage','index');
		}
	}

	/*
	 *  IDからキャラクターを特定する
	 */
	public function setChara()
	{
		// キャラクターIDの取得をする
		$charaId = $_GET['uCharaId'];
		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('Chara','getById',$charaId);
		return ($this->Lib->redirect('charastatus',"",$selectedChara));
	}
}
