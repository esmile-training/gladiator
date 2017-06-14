<?php
/*
キャラクターの所持制限処理のライブラリ
作成者：松井勇樹
最終更新日：2017/06/13
*/
// 名前空間
namespace App\Libs;

// クラスの定義
class ManageCharaPossessionLib extends BaseGameLib
{
	/*
		ユーザーの所持キャラの上限数を取得する
	*/
	public function getUpperLimitChara($argUserId)
	{
		// DBからキャラ所持数の上限を取得する
		$upperLimit = $this->Model->exec('User', 'getUpperLimitChara', $argUserId);
		return $upperLimit;
	}

	/*
		所持キャラ数を取得する
	*/
	public function getPossessionChara($argUserId)
	{
		// DBからキャラ所持数を取得する
		$PossessionChara = $this->Model->exec('User', 'getPossessionChara', $argUserId);
		return $PossessionChara;
	}

	/*
		キャラの所持数を加算する
	*/
	public function addPossessionChara($argUser)
	{
		// 所持キャラ数に1を加算する
		$argUser['possessionChara'] += 1;
		// データベースの更新をする
		$this->Model->exec('User','UpdatePossessionChara',array($argUser));
	}

	/*
		キャラの所持数を減算する
	*/
	public function subPossessionChara($argUser)
	{
		if($argUser['possessionChara'] > 0)
		{
			// 所持キャラ数に1を加算する
			$argUser['possessionChara'] -= 1;
			// データベースの更新をする
			$this->Model->exec('User','UpdatePossessionChara',array($argUser));
		}
	}

	/*
		キャラクターの所持枠を追加する
	*/
	public function addUpperLimit($argUser)
	{
		// 所持キャラ数の上限に10(仮)を加算する
		$argUser['upperLimitChara'] += 10;
		// データベースを更新する
		$this->Model->exec('User','UpdateUpperLimitChara',array($argUser));
	}

	/*
		キャラの所持数が上限を超えているかを確認する
		超えていればtrue,超えていなければfalseを返す
	*/
	public function checkUpperLimit($argUser)
	{
		// キャラの所持数を取得する
		$possession = $this->Model->exec('User','getPossessionChara' , $argUser['id']);
		// キャラ所持数の上限を取得する
		$upperLimit = $this->Model->exec('User', 'getUpperLimitChara', $argUser['id']);

		// 現在の所持数が、所持上限を超えていないか確認する
		if($possession['possessionChara'] >= $upperLimit['upperLimitChara'])
		{
			return true;
		}
		else
		{
			return false;
		}

	}
}
