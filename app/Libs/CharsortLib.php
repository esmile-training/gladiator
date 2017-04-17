<?php
namespace App\Libs;

class charsortLib
{
	/*
	*	メンバーコンフィグを職業別に配列しなおす
	*/
    public static function charctersort()
    {
	// 配列に値をセット
        $listPw = []; 

	// userの配列から特定の値を取得
        foreach (\Config::get('user') as $key => $value){ //  pw . def => ?? . ??
          $listPw[$key] = $value['pw'];
        }
	
	// $_GETが使えないのでfilter_inputを使用
	$getselect = filter_input(INPUT_GET, 'match');

	if ($getselect === "down") {
	    // 結果を昇順
	    arsort($listPw, SORT_NUMERIC);
	}else{
	    // 結果を降順
	    asort($listPw, SORT_NUMERIC);
	}

        return $listPw;
    }
}