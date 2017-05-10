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
		$alluChara = $this->Model->exec('UChara','getUserChara',$userId);

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
			// キャラクターのデータが無ければ、マイページへリダイレクトする
			$this->Lib->redirect('mypage','index');
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
		$selectedChara = $this->Model->exec('UChara','getById',$charaId);
		//var_dump($selectedChara);
		return ($this->Lib->redirect('charastatus',"",$selectedChara));
		
		exit();

		// 要素ごとに切り分ける。
		$uCharaId = $selectedChara['id'];
		$hp = $selectedChara['hp'];
		$gooAtk = $selectedChara['gooAtk'];
		$choAtk = $selectedChara['choAtk'];
		$paaAtk = $selectedChara['paaAtk'];

		// データをDBへインサートする
		$test = $this->Model->exec('UChara','insertChara',array($uCharaId,$hp,$gooAtk,$choAtk,$paaAtk));
		var_dump($test);
		// ステージ選択(エネミー選択)へリダイレクトする

	}
}

