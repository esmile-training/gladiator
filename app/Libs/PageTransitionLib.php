<?php
namespace App\Libs;

class PageTransitionLib extends BaseGameLib
{
    public function  pageTransition()
    {
	
	//　next, back, fullnext, fullbackボタンが押された時の代入変数
	$inputrank = 0;
	
	/*
	 * 最上位～最下位までのジャンプボタン
	 */

	// 
	$fullnextrank = filter_input(INPUT_COOKIE, 'fullnext');
	$floorfullnext = floor(($fullnextrank/10))*10;
	
	//
	$fullbackrank = filter_input(INPUT_GET, 'fullback');
	

	if(isset($fullnextrank) && $fullnextrank == $floorfullnext){
	    $fullnextrank = $floorfullnext - 10;
	    $inputrank = [$fullnextrank];
	} else {
	    $inputrank = [$floorfullnext];
	}
	    

	
	if(isset($fullbackrank)) {
	    $inputrank = [$fullbackrank];
	}

	
	/*
	 * 一ページずつ遷移するボタン
	 */
	
	// ページ更新ボタン next
	$nextrank = filter_input(INPUT_GET, 'next');

	// ページ更新ボタン back
	$backrank = filter_input(INPUT_GET, 'back');

	

	if(isset($nextrank)){    // (next)
	    // 順位の最大値を代入
	    $inputrank = [$nextrank];

	}elseif(10 < $backrank && isset($backrank)){    // (back)
	    // 順位の最大値から差分を引いてそこに9を足し、
	    // 前ランクの最高順位に調整
	    $backfloor = floor(($backrank/10))*10;

	    if($backfloor == $backrank){
		$backrank = floor($backrank) - 20;
		$inputrank = [$backrank];

	    } else {
		$backrank = $backrank - (($backrank + 10) - $backfloor);
		$inputrank = [$backrank];

	    }		

	}
	
	if (!isset($fullnextrank) && !isset($fullbackrank) && !isset($nextrank) && !isset($backrank)) {
	    //最初のページ読み取り時のみ実行
	    // 初期値には０を代入
	    $inputrank = [0];
	}
	

	return $inputrank;
    }
}

