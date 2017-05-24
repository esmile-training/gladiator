<?php

namespace App\Http\Controllers;

class RankingController extends BaseGameController
{
    private $rankingData;
    private $chengeData;
	private $chenge;
    
    public function __construct()
    {
		// 親のコンストラクタをオーバーライド
		parent::__construct();

		// 表示タブの切り替え
		$this->chengeData   = filter_input(INPUT_GET, 'dataChenge');

		// 以前の表示タブの状態を取得
		$this->chenge	    = filter_input(INPUT_GET, 'pageType');

		/*
		 *  総合か週間が選ばれたときに実行される。
		 * 押されてない場合は初期値に0を代入
		 */

		if (isset($this->chengeData) && $this->chengeData == 0)
		{
			$chengeRanking  = 0;
		}
		elseif(isset($this->chengeData) && $this->chengeData == 1)
		{
			$chengeRanking  = 1;
		}
		elseif(isset($this->chenge) && !isset($this->chengeData))
		{
			$chengeRanking  = $this->chenge;
		}
		else
		{
			$chengeRanking  = 0; 
		}

		// 週間か総合値順位のボタンの状態判定
		if($chengeRanking == 0)
		{
			// 週間とステータスの切り替え
			$this->rankingData['rankChenge'] = $chengeRanking;
		}
		else
		{
			// ステータスの最下位のデータを取得
			$bottomData = $this->Model->exec('Ranking', 'bottomStatus');
			$bottomData[0]['totalCharaStatus'] == null ? $bottomData = 0 : false;

			$this->rankingData['bottomStatus'] = $bottomData;

			// 登録者数を取得
			$charaCount = $this->Model->exec('Ranking', 'countUser');
			$this->rankingData['count'] = floor(($charaCount[0]['count']/10));

			// 週間とステータスの切り替え
			$this->rankingData['rankChenge'] = $chengeRanking; 
		}
	}


    public function index()
    {
		// ページャーの取得
		$nextPage   = filter_input(INPUT_GET, 'next');
		$backPage   = filter_input(INPUT_GET, 'back');
		$lastPage   = filter_input(INPUT_GET, 'last');
		$firstPage  = filter_input(INPUT_GET, 'first');
		$rangePage  = filter_input(INPUT_GET, 'page');

		// 配列化
		$pushPage   = [$nextPage, $backPage, $lastPage, $firstPage, $rangePage];
		$moldValue  = $this->Lib->exec('Pager', 'valueConf', $pushPage);
		$this->rankingData['nowpage']	= $moldValue;


		// 週間かステータスで取得データを切替
		if ($this->rankingData['rankChenge'] == 0)
		{
			$range  = $this->Lib->exec('WeekRange', 'rangeState', $this->user['id']);

			// 登録者数を取得
			$userCount = $this->Model->exec('Ranking', 'countRange', $range);
			$this->rankingData['count']	= ceil(($userCount[0]['count']/10));

			if(!isset($nextPage) && !isset($backPage) && !isset($lastPage) && !isset($firstPage) && !isset($rangePage))
			{
				$userRank   = $this->Model->exec('Ranking', 'userRank', [$this->user['id'], $range]);
				$page	    = RankingController::userRanking($userRank);
			}
			else
			{
				// ユーザーランキング
				$page	= $this->Model->exec('Ranking', 'rankingPager', [$moldValue, $range]);
			}
		}
		else
		{
			// 所持キャラランキング
			$page   = $this->Model->exec('Ranking', 'rankingStatus', $moldValue);
		}


		// 並べ替えたものを代入
		$this->viewData['ranking']	= $page;
		$this->viewData['rankingData']	= $this->rankingData;
		var_dump($this->viewData);
		// ビューヘ渡す
		if ($this->rankingData['rankChenge'] == 0)
		{
			return viewWrap('userRanking', $this->viewData);
		}
		else
		{
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
	// ユーザーが添字配列の何番目にいるかを取得
	$userrank = array_search($this->user['id'], array_column($inputRank, 'userId'));
	
	// ページャーの値を初期化
	$pager = 0;
	
	foreach ($inputRank as $key => $value)
	{
	    // ランキングの総数が10人未満だった場合
	    if(count($inputRank) < 10)
	    {
		$execRank[$value['userId']]	= $value;
	    }
	    // ランキング取得時、中間ではなく、上位十位以内だった場合
	    elseif($inputRank[9]['userId'] != $this->user['id'] && 10 > $userrank && $key < 10)
	    {
		$execRank[$value['userId']]	= $value;
	    }
	    // ランキング取得時中間にいて尚且つ、取得合計数が20と異なるとき
	    elseif($inputRank[9]['userId'] == $this->user['id'] && count($inputRank) != 20)
	    {
		$execRank[$value['userId']]	= $value;
	    }
	    // ランキング取得時中間にだけいるとき
	    elseif($inputRank[9]['userId'] == $this->user['id'] && 4 < $key && $key < 15)
	    {
		$execRank[$value['userId']]	= $value;
		$pager = $inputRank[$key]['rank'];
	    }
	}
		$this->rankingData['pager'] = floor(($pager / 10)) * 10;
		return $execRank;
    }
}
