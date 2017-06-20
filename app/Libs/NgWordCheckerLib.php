<?php
/*
禁止ワード検出ライブラリ
作成者：松井 勇樹
最終更新日：2017/06/08
*/
// 名前空間の設定
namespace App\Libs;

class NgWordCheckerLib extends BaseGameLib
{
	/*
	* NGワードのチェック関数
	*/
	public function check($argString)
	{
		// 加工するために文字列を変数に格納する
		$string = $argString;
		// チェック用のワードリストを取得する
		$wordList = \Config::get('wordCheckList');
		// リストから禁止ワードを取得する
		$ngWords = $wordList['ngWord'];
		// リストから許可ワードを取得する
		$okWords = $wordList['okWord'];

		// 禁止ワードの検出フラグ,検出したらtrueになる
		$ngFlag = false;

		// 文字列内の英文字をすべて小文字に変換する
		$string = mb_strtolower($string,'utf-8');
		// 文字列内の仮名文字とスペースをすべて半角に変換する
		$string = mb_convert_kana($string,'asKV','utf-8');
		// スペースや句読点を取り除く
		$string = preg_replace('/\s|、|。/','',$string);

		// 許可ワードを別の文字(#)へ変換する
		foreach ($okWords as $okWordValue)
		{
			if(strpos($string,$okWordValue) !== false)
			{
				$string = str_replace($okWordValue,'*',$string);
			}
		}

		// 禁止ワードを検索する
		foreach ($ngWords as $ngWordValue)
		{
			if(strpos($string,$ngWordValue) !== false)
			{
				$ngFlag = true;
				break;
			}
		}

		// NGワードを検出したらtrueを返す
		return $ngFlag;
	}

}
