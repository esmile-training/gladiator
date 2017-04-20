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

	    // クッキーにランクの切り替えをセットする。
	    setcookie('rankChange', $rankChange);

	    
	    // 最下位のデータを取得
	    $bottomRank = $this->Model->exec('Ranking', 'bottomAcquisition');
	    
	    // 登録者数を取得
	    $userCount = $this->Model->exec('Ranking', 'idRegistrationNumber');
	    
	    // 最下位の最新総合獲得ポイントを取得
	    setcookie('bottom', $bottomRank[0]['totalPoint']);
	    
	    // ユーザーのランキング総数を取得
	    setcookie('count', $userCount[0]['count']);
    }

}