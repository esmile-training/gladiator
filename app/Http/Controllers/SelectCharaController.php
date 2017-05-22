<?php

// 名前空間の使用宣言
namespace App\Http\Controllers;

// クラス定義
class SelectCharaController extends BaseGameController
{

	public function listSort()
	{
		$type = $_GET['type'];
		$order = $_GET['order'];
		// ユーザーIDを取得する
		$userId = $this->user['id'];
		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('Chara','getAllUserChara',$userId);

		// DBからキャラクターを取得できたかを確認する
		if(isset($alluChara))
		{	
			$order = (int)$order;
			array_multisort(array_column($alluChara, $type), $order, $alluChara);
//			//並べ替え処理
//			$tmpArray = array();
//			foreach ((array)$alluChara as $key => $row ) {
//				$tmpArray[$key] = $row[$type];
//			}
//			array_multisort( $tmpArray, $order, $alluChara );
//			//var_dump($tmpArray);exit;
//			unset( $tmpArray );
			
			
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
