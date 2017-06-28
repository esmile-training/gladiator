<?php

namespace App\Libs;

class PresentboxLib extends BaseGameLib
{
	//一括受け取りボタンが押された場合の処理
	public function receiveAll($user,$receiveData,$charaInventory)
	{
		//キャラIDの最小値取得
		$charaIdMin = 0;
		//キャラIDの最大値取得
		$charaIdMax = 0;
		
		$presentCharaIdMin = 0;
		//キャラ受け取り可能数
		$charaCntLimit = $charaInventory['upperLimit'] - $charaInventory['possession'];
		//所持数を超えないようカウント
		$charaDataCnt = 0;
		
		//各アイテムの件数カウント用の変数
		$yakusoCnt = 0;
		$nikuCnt = 0;
		$sunaCnt = 0;
		
		//金額の合計値を格納する変数
		$total = 0;
		
		foreach($receiveData as $val)
		{
			//ボックスに入ってるオブジェクトの種類によって処理を分ける
			switch($val['type'])
			{
				//キャラクターの場合
				case 1:
					//キャラ受け取り可能数と現在入ってきたキャラクターの数を比較
					if($charaCntLimit > $charaDataCnt && $presentCharaIdMin > $val['id'] || $presentCharaIdMin == 0)
					{
						$presentCharaIdMin = $val['id'];
						$charaDataCnt++;
						
						if($charaIdMax < $val['objId'])
						{
							$charaIdMax = $val['objId'];
						}
						if($charaIdMin > $val['objId'] || $charaIdMin == 0)
						{
							$charaIdMin = $val['objId'];
						}
						// 所持キャラ数の加算を行う
						$this->Lib->exec('ManageCharaPossession','addPossessionChara',array($user));
					}
					break;
				//アイテムの場合
				case 2:
					//アイテムの種類別にカウント
					switch($val['objId'])
					{
						//回復アイテムカウント
						case 2:
							$yakusoCnt = $yakusoCnt + $val['cnt'];
							break;
						//攻撃力上昇アイテムカウント
						case 3:
							$nikuCnt = $nikuCnt + $val['cnt'];
							break;
						//訓練時間短縮アイテムカウント
						case 4:
							$sunaCnt = $sunaCnt + $val['cnt'];
							break;
					}
					break;
				
				//お金の場合
				case 3:
					$total = $total +  $val['cnt'];
					break;
				
				default:
					break;
			}
		}
		
		//各アイテムの取得個数に応じてデータベースを更新
		//※ここは後で大きく修正するかもしれないです。
		if($yakusoCnt != 0)
		{
			$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
			$this->itemData			= \Config::get('item.itemStr');
			$updateItemData = $this->Lib->exec('Belongings','updateItem',array(2,$yakusoCnt,$this->itemData,$this->belongingsData,$user));
			// DBの更新
			$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		}
		if($nikuCnt != 0)
		{
			$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
			$this->itemData			= \Config::get('item.itemStr');
			$updateItemData = $this->Lib->exec('Belongings','updateItem',array(3,$nikuCnt,$this->itemData,$this->belongingsData,$user));
			// DBの更新
			$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		}
		if($sunaCnt != 0)
		{
			$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
			$this->itemData			= \Config::get('item.itemStr');
			$updateItemData = $this->Lib->exec('Belongings','updateItem',array(4,$sunaCnt,$this->itemData,$this->belongingsData,$user));
			// DBの更新
			$this->Model->exec('Item', 'updateItemData', array($updateItemData));
		}
		
		//所持金更新
		$this->Lib->exec('Money','addition',array($user, $total));
		//キャラのacceptFlag更新
		if($charaIdMin == $charaIdMax)
		{
			$this->Model->exec('chara','charaAcceptFlag',$charaIdMax);
		}else{
			$this->Model->exec('chara','rangeCharaAcceptFlag',array($user['id'],$charaIdMin,$charaIdMax));
		}
		//受け取りボックスデータベース更新
		$this->Model->exec('presentBox','changeDelFlagAll',array($user['id'],$presentCharaIdMin));
	}
}