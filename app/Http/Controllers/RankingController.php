<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
    public $rankingData;
    
    public function __construct()
    {
	// 親のコンストラクタをオーバーライド
	parent::__construct();
	// 総合か習慣の切り替え
	$rankChange = 0;

	// 総合ランキング
	$totalRank = filter_input(INPUT_GET, 'total');

	// 週間ランキング
	$weekRank = filter_input(INPUT_GET, 'week');

	/*
	 *  総合か週間が選ばれたときに実行される。
	 * 押されてない場合は初期値に0を代入
	 */

	if (isset($totalRank) && $totalRank == 0) { 
	    $rankChange = filter_input(INPUT_GET, 'total'); 
	} elseif (isset($weekRank) && $weekRank == 1) { 
	    $rankChange = filter_input(INPUT_GET, 'week'); 
	}else{ 
	    $rankChange = 0; 
	} 

	// 最下位のデータを取得
	$bottomData = $this->Model->exec('Ranking', 'bottomAcquisition');
	$this->rankingData['bottomPoint'] = $bottomData[0]['totalPoint'];

	// 登録者数を取得
	$userCount = $this->Model->exec('Ranking', 'idRegistrationNumber');
	$this->rankingData['count'] = floor(($userCount[0]['count']/10));

	// 総合と週間の切り替え
	$this->rankingData['rankChange'] = $rankChange;
    }


    public function index()
    {
	// ページャーの取得
	$nextPage = filter_input(INPUT_GET, 'next');
	$backPage = filter_input(INPUT_GET, 'back');
	$lastPage = filter_input(INPUT_GET, 'last');
	$firstPage = filter_input(INPUT_GET, 'first');
	
	// 配列化
	$getPage = [$nextPage, $backPage, $lastPage, $firstPage];
	
	// ページの切り替え
	$inputRank = $this->Lib->exec('Pager', 'valueConf', $getPage);
	var_dump($inputRank);
	// ページの取得
	$sortRank = $this->Lib->exec('GetPage', 'userRank', [$inputRank, $this->user['id']]);

	// 並べ替えたものを代入
	$this->viewData['ranking'] = $sortRank;
	$this->viewData['rankingData'] = $this->rankingData;

	// ビューヘ渡す
	return viewWrap('ranking', $this->viewData);
    }
}
