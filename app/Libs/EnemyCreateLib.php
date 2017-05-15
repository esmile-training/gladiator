<?php
/*
 * エネミー作成ライブラリ
 * 作成者：松井 勇樹
 * 最終更新日：2017/05/01
 */
namespace App\Libs;

class EnemyCreateLib extends BaseGameLib
{
	/*
	 * エネミーの外見(性別を含む)を取得する
	 */
	static function getEnemyAppearance()
	{
		// エネミーの外見情報を格納する配列
		$enemyApp = array();
		// charaの情報を取得する
		$charaConf = \Config::get('chara.imgId');
		// 取得したデータの中からランダムで一つ選択する
		$imgId = rand(1, count($charaConf));
		// 外見のデータを配列に格納する
		$enemyApp['imgId'] = (string)$imgId;
		$enemyApp['sex'] = (string)$charaConf[$imgId]['sex'];

		return $enemyApp;
	}

	/*
	 * 名前の生成をする
	 */
	static function creatEnemyName($sexData)
	{
		// 名前を格納する配列
		$name = array();
		// エネミーの情報を取得する
		$charaConf = \Config::get('chara.allname');
		//firstname配列の中からランダムで一つ取得する
		$FirstNameId = array_rand($charaConf['firstname'][$sexData]);
		//lastname配列の中からランダムで一つ取得する
		$LastNameId = array_rand($charaConf['lastname']);
		// 作成した名前を配列に格納する
		$name['firstname'] = $charaConf['firstname'][$sexData][$FirstNameId];
		$name['lastname'] = $charaConf['lastname'][$LastNameId];
		return $name;
	}

	/*
	 * エネミーのステータスを作成する
	 * ユーザーキャラのHPと大会の難易度を使用する
	 */
	static function createEnemyStatus($uCharaHp,$arenaDifficulty)
	{
		// エネミーのステータスを格納する配列
		$enemyStatus = array();
		// enemyStatusOffsetを取得する
		$offsetConf = \Config::get('battle.difficultyStr');
		// offsetConfから難易度に対応した数値を取得する
		$offset = (float)$offsetConf[$arenaDifficulty]['enemyRatio'];
		//uCharaHPを数値に変換する
		$ConverteduCharaHp = (int)$uCharaHp;
		// エネミーの基準値を求める
		$enemyStandardValue = ($ConverteduCharaHp / 3) * $offset;
		// 最大割合
		$maxRatio = 110;
		// 最小割合
		$minRatio = 90;

		// グーの攻撃力を算出する
		$ratio1 = mt_rand($minRatio, $maxRatio) * 0.01;
		$gooAtk = $enemyStandardValue * $ratio1;

		// チョキの攻撃力を算出する
		if($ratio1 * 100 < 100)
		{
			$minRatio += abs($ratio1 * 100 - 100);
		} else if ($ratio1 * 100 > 100){
			$maxRatio -= abs($ratio1 * 100 - 100);
		}
		$ratio2 = mt_rand($minRatio, $maxRatio) * 0.01;
		$choAtk = $enemyStandardValue * $ratio2;

		// パーの攻撃力を計算する
		$paaAtk = $enemyStandardValue * 3 - ($gooAtk + $choAtk);
		// HPを算出する
		$hp = $ConverteduCharaHp * $offset;
		if($hp < $enemyStandardValue * 3 - 1)
		{
			$hp += 1;
		}
		// 配列に格納する
		$enemyStatus['gooAtk']	= (int)$gooAtk;
		$enemyStatus['choAtk']	= (int)$choAtk;
		$enemyStatus['paaAtk']	= (int)$paaAtk;
		$enemyStatus['hp']		= (int)$hp;

		return $enemyStatus;
	}
}