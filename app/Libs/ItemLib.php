<?php

namespace App\Libs;

class ItemLib extends BaseGameLib
{
	public function item2($user)
	{
	}

	public function item3($user)
	{	
	}


	public function item4($infoData, $number, $ability)
	{	
		// 元々の訓練終了時間
		$beforeEndDate = $infoData['endDate'];
		
		// 訓練を短縮する時間をアイテムの個数(number)と1個で短縮できる時間($ability)によって算出
		$shorteningTime = $ability * $number;
		
		// アイテム使用後の訓練終了時間を生成
		$afterEndDate = date("Y-m-d H:i:s",strtotime("$beforeEndDate -$shorteningTime hours"));

		return $afterEndDate;
	}
}
