<?php

namespace App\Libs;

class SortLib {
	/* 多次元配列をソートする
	   $array : 並べ替えたい二次元配列
	   $key   : 並べ替えるインデックス
	   $SORT_DESC : 降順であればtrue、昇順はfalse
	 */
	public function sortArray($array, $key, $SORT_DESC = false){
		$SORT_DESC = ($SORT_DESC==false)?SORT_ASC : SORT_DESC;
		array_multisort(array_column($array, $key), $SORT_DESC , $array);
		return $array;
	}
}
