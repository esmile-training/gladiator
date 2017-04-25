<?php
namespace App\Libs;

class FirstLoadingLib extends BaseGameLib
{
    public function index()
    {
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
	    
	    if (isset($totalRank) && $totalRank == 0) { $rankChange = filter_input(INPUT_GET, 'total'); } 
	    if (isset($weekRank) && $weekRank == 1) { $rankChange = filter_input(INPUT_GET, 'week'); }
	    if (!isset($totalRank) && !isset($weekRank)) { $rankChange = 0; } 
	    
	    // 最下位のデータを取得
	    $bottomData = $this->Model->exec('Ranking', 'bottomAcquisition');
	    $rankingData['bottomPoint'] = $bottomData[0]['totalPoint'];
	    
	    // 登録者数を取得
	    $userCount = $this->Model->exec('Ranking', 'idRegistrationNumber');
	    $rankingData['count'] = floor(($userCount[0]['count']/10));
	    
	    // 総合と週間の切り替え
	    $rankingData['rankChange'] = $rankChange;
	    
	    return $rankingData;
    }

}