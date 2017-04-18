<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
	public function index()
	{
	    setcookie('id', '1');
	    
	    // cookieを代入
	    $cookie = filter_input(INPUT_COOKIE, "id");
	    
	    // cookieの確認
	    isset($cookie) ? true : exit();
	    
	    // ページ更新ボタン next
	    $nextrank = filter_input(INPUT_GET, 'next');
	    
	    // ページ更新ボタン back
	    $backrank = filter_input(INPUT_GET, 'back');
	    
	    //　next, backボタンが押された時の代入変数
	    $inputrank = 0;
	    
	    if(isset($nextrank)){    // (next)
		// 順位の最大値を代入
		$inputrank = [$nextrank];
		
	    }elseif(10 < $backrank && isset($backrank)){    // (back)
		// 順位の最大値から差分を引いてそこに9を足し、
		// 前ランクの最高順位に調整
		$backrank = ($backrank - 20) + 9;
		
		// 順位の最大値を代入
		$inputrank = [$backrank];
		
	    }else{
		// 初期値には０を代入
		$inputrank = [0];
	    }
	    
	    

	    
	    // DB接続
	    $getrank = $this->Model->exec('User', 'getByrank', [$inputrank]);
	    $sortrank = [];

	    //var_dump($getrank);
	    
	    
	    foreach ($getrank as $value) {
		$sortrank[$value['username']] = $value['upoint'];
	    }

	    arsort($sortrank, SORT_NUMERIC);
	    
	    //$rank['rank'] = $sortrank;
	    
	    foreach ($sortrank as $key => $value) {
		$sortrank[$key] = [$value, ++$inputrank[0]];
	    }

	    $rank['rank'] = $sortrank;
	    var_dump($rank);
	    
	    return view('ranking', $rank);
	}
}