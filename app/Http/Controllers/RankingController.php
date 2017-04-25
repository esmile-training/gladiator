<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
	public function index()
	{
	    
	    // ページ読み込み時に実行
	    $rankingData = $this->Lib->exec('FirstLoading', 'index');
	    
	    // 順位ページの切り替え
	    $inputRank = $this->Lib->exec('PageTransition', 'pageTransition');
	    
	    // 総合成績を降順にソート
	    $sortRank = $this->Lib->exec('RankSort', 'rankSort', [$inputRank, $this->user['id']]);

	    // 並べ替えたものを代入
	    $rank['rank'] = $sortRank;
	    $rank['rankingData'] = $rankingData;
	    
	    // ビューヘ渡す
	    return view('ranking', $rank);
	}
}
