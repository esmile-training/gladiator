<?php

namespace App\Libs;

class ItemLib extends BaseGameLib
{
	/* 
	 * item2(バトル中攻撃力上昇アイテム)の処理
	 * battleCharaData	: バトル中のキャラのデータ
	 * ability			: 能力値(config管理)上昇倍率
	 */
	public function item2($battleCharaData, $ability)
	{
		
		$healData['hp']		= $battleCharaData['hp'];
		$healData['skill']	= $ability / 100;

		// HP回復処理
		$battleCharaData['battleHp'] = $this->Lib->exec('battle', 'charaHeal',array($battleCharaData['battleHp'], $healData));
		
		return $battleCharaData['battleHp'];
	}

	/* 
	 * item3(バトル中攻撃力上昇アイテム)の処理
	 * battleCharaData	: バトル中のキャラのデータ
	 * ability			: 能力値(config管理)上昇倍率
	 */
	public function item3($beforeAtk, $ability)
	{
		// 攻撃力上昇処理
		$afterAtk = $this->Lib->exec('battle', 'atkUP',array($beforeAtk, $ability));

		return $afterAtk;
	}

	/*
	 * item4(訓練時間短縮アイテム)の処理
	 * infoData	: 訓練データ
	 * number	: 個数
	 * ability	: 能力値(config管理)短縮時間
	 */
	public function item4($infoData, $number, $ability)
	{
		// 元々の訓練終了時間
		$beforeEndDate = $infoData['endDate'];
		
		// 訓練を短縮する時間をアイテムの個数(number)と1個で短縮できる時間($ability)によって算出
		$shorteningTime = $ability * $number;
		
		// アイテム使用後の訓練終了時間を生成
		$afterEndDate = date("Y-m-d H:i:s",strtotime("$beforeEndDate -$shorteningTime hours"));
		
		// uTraing の endDate を更新
		$this->Model->exec('Training', 'updateEndDate', array($infoData['id'], $afterEndDate));
	}
}