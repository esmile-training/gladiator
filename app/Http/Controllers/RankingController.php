<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
    public $rankingData;
    public $execRank = [];
    
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
	$pushPage = [$nextPage, $backPage, $lastPage, $firstPage];
	
	// ページの切り替え
	if(!isset($nextPage) && !isset($backPage) && !isset($lastPage) && !isset($firstPage))
	{
	    $userRank = $this->Model->exec('Ranking', 'userRank', $this->user['id']);
	    $page = RankingController::userRanking($userRank);
	}else{
	    $moldValue = $this->Lib->exec('Pager', 'valueConf', $pushPage);
	    $page = $this->Model->exec('Ranking', 'nextPage', $moldValue);
	}

	// 並べ替えたものを代入
	$this->viewData['ranking'] = $page;
	$this->viewData['rankingData'] = $this->rankingData;

	// ビューヘ渡す
	return viewWrap('ranking', $this->viewData);
    }
    
    
    
    
    public function userRanking($inputRank)
    {
	$userrank = array_search($this->user['id'], array_column($inputRank, 'userId'));

	// ランキング取得時、中間ではなく、上位十位以内だった場合
	if($inputRank[9]['userId'] != $this->user['id'] && 10 > $userrank)
	{
	    foreach ($inputRank as $key => $value)
	    {
		if($key < 10)
		{
		    $execRank[$value['name']] = $value;
		    var_dump($inputRank[$key]);
		}
    	    }
	}elseif($inputRank[9]['userId'] == $this->user['id'] && count($inputRank) != 20){
	// ランキング取得時中間にいて尚且つ、取得合計数が20と異なるとき
	    foreach ($inputRank as $key => $value)
	    {
		if(count($inputRank) - 11 < $key)
		{
		    $execRank[$value['name']] = $value;
		    var_dump($inputRank[$key]);
		}
	    }
	}elseif($inputRank[9]['userId'] == $this->user['id']){
	// ランキング取得時中間にだけいるとき
	    foreach ($inputRank as $key => $value)
	    {
		if(4 < $key && $key < 15)
		{
		    $execRank[$value['name']] = $value;
		    $data = $inputRank[$key]['rank'];   
		}
	    }
	}
	$this->rankingData['pager'] = floor(($data / 10)) * 10;
	
	return $execRank;
    }
}
