<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
	public function index()
	{
	    
	    // ページ読み込み時に実行
	    $this->Lib->exec('FirstLoading', 'index');
	    
	    // 順位ページの切り替え
	    $inputrank = $this->Lib->exec('PageTransition', 'pagetransition');
	    
	    // 総合成績を降順にソート
	    $sortrank = $this->Lib->exec('RankSort', 'ranksort', [$inputrank]);

	    // 並べ替えたものを代入
	    $rank['rank'] = $sortrank;
	    
	    // ビューヘ渡す
	    return view('ranking', $rank);
	}
}
