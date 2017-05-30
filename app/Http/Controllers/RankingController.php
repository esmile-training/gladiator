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
			$this->rankingData['count']	= floor(($userCount[0]['count']/10));

			if(!isset($nextPage) && !isset($backPage) && !isset($lastPage) && !isset($firstPage) && !isset($rangePage))
			{
				$pagecount   = $this->Model->exec('Ranking', 'overPoint', [$this->user['id'], $range]);
				$count	= floor($pagecount['count'] / 10) * 10;
				$this->rankingData['nowpage']	= $count;
				$page = $this->Model->exec('Ranking', 'rankingPager', [$range, $count]);
				
			}
			else
			{
				// ユーザーランキング
				$page	= $this->Model->exec('Ranking', 'rankingPager', [$range, $moldValue]);
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
}
