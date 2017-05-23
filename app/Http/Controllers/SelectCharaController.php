<?php

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{
	public function index()
	{
		if(!isset($_GET['type'])){
			$type = 'id';
		} else {
			$type = $_GET['type'];
		}
		
		if(!isset($_GET['order'])){
			$order = 'asc';
		} else {
			$order = $_GET['order'];
		}

		return $this->listSort($type, $order);
	}
	
	public function listSort($type, $order)
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];
		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('Chara','getAllUserChara',$userId);
		// DBからキャラクターを取得できたかを確認する
		if(isset($alluChara))
		{	
			$order = (int)$order;
			array_multisort(array_column($alluChara, $type), $order, $alluChara);			
			// viewDataへ取得したキャラクターを送る
			$this->viewData['charaList'] = $alluChara;
			// ビューへデータを渡す
			return viewWrap('selectChara',$this->viewData);
		}
		else
		{
			//キャラクターがいない場合リストを空にして渡す
			$this->viewData['charaList'] = null;
			return viewWrap('selectChara',$this->viewData);
		}
	}
}
