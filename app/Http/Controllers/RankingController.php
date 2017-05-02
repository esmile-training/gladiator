<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
    public $rankingData;
    public $execRank = [];
    public $chengeData;
    public $chenge;
    
    public function __construct()
    {
	// 親のコンストラクタをオーバーライド
	parent::__construct();

	// 表示タブの切り替え
	$this->chengeData = filter_input(INPUT_GET, 'dataChenge');
	
	// 以前の表示タブの状態を取得
	$this->chenge = filter_input(INPUT_GET, 'pageType');
	
	/*
	 *  総合か週間が選ばれたときに実行される。
	 * 押されてない場合は初期値に0を代入
	 */
	
	if (isset($this->chengeData) && $this->chengeData == 0) {
	    $chengeRanking = 0;
	} elseif (isset($this->chengeData) && $this->chengeData == 1) {
	    $chengeRanking = 1;
	}elseif(isset($this->chenge) && !isset($this->chengeData)){
	    $chengeRanking = $this->chenge;
	}else{
	    $chengeRanking = 0; 
	}

	// 週間か総合値順位のボタンの状態判定
	if($chengeRanking == 0){
	    // 最下位のデータを取得
	    $bottomData = $this->Model->exec('Ranking', 'bottomAcquisition');
	    $this->rankingData['bottomPoint'] = $bottomData[0]['weeklyAward'];

	    // 登録者数を取得
	    $userCount = $this->Model->exec('Ranking', 'idRegistrationNumber');
	    $this->rankingData['count'] = floor(($userCount[0]['count']/10));

	    // 週間とステータスの切り替え
	    $this->rankingData['rankChenge'] = $chengeRanking;
	}else{
	    // ステータスの最下位のデータを取得
	    $bottomData = $this->Model->exec('Ranking', 'bottomStatus', $this->user['id']);
	    $this->rankingData['bottomStatus'] = $bottomData[0]['hp'];
	    
	    // 登録キャラ数を取得
	    $charaCount = $this->Model->exec('Ranking', 'charaCount', $this->user['id']);
	    $this->rankingData['count'] = floor(($charaCount[0]['count']/10));

	    // 週間とステータスの切り替え
	    $this->rankingData['rankChenge'] = $chengeRanking; 
	}
    }


    public function index()
    {
	// ページャーの取得
	$nextPage = filter_input(INPUT_GET, 'next');
	$backPage = filter_input(INPUT_GET, 'back');
	$lastPage = filter_input(INPUT_GET, 'last');
	$firstPage = filter_input(INPUT_GET, 'first');
	$rangePage = filter_input(INPUT_GET, 'page');
	
	// 配列化
	$pushPage = [$nextPage, $backPage, $lastPage, $firstPage, $rangePage];

	// 初期画面を出力
	if(!isset($nextPage) && !isset($backPage) && !isset($lastPage) && !isset($firstPage) && !isset($rangePage) && $this->chengeData == 0)
	{
	    $userRank = $this->Model->exec('Ranking', 'userRank', $this->user['id']);
	    $page = RankingController::userRanking($userRank);
	}else{
	    // 週間かステータスで取得データを切替
	    if ($this->rankingData['rankChenge'] == 0){
		// ユーザーランキング
		$moldValue = $this->Lib->exec('Pager', 'valueConf', $pushPage);
		$page = $this->Model->exec('Ranking', 'rankingPager', [$moldValue]);
	    }else{
		// 所持キャラランキング
		$moldValue = $this->Lib->exec('Pager', 'valueConf', $pushPage);
		$this->rankingData['nowpage'] = $moldValue;
		$page = $this->Model->exec('Ranking', 'rankingChara', [$moldValue, $this->user['id']]);
	    }
	}

	// 並べ替えたものを代入
	$this->viewData['ranking'] = $page;
	$this->viewData['rankingData'] = $this->rankingData;

	// ビューヘ渡す
	if ($this->rankingData['rankChenge'] == 0) {
	    return viewWrap('userRanking', $this->viewData);
	}else{
	    return viewWrap('charaRanking', $this->viewData);
	}
    }
    
    
    
    /*
     * 
     * 初期画面の表示切替
     * 
     */
    
    public function userRanking($inputRank)
    {
	$data = 0;
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
