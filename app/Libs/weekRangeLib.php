<?php

namespace App\Libs;


class weekRangeLib extends BaseGameLib{
    /*
     * 週間の状態を確認
     */
    public function rangeState($userId)
    {
	// ユーザの週間を取得
	$week = $this->Model->exec('Ranking', 'getRange', $userId);
	
	// 今週の最終日を取得
	$monday = date('Y-m-d', strtotime('last monday'));
	
	// 今週の最終日とデータベースの週間を比較
	if($monday != $week[0]['weekRange']){
	    echo 'ok';
	    $this->Model->exec('Ranking', 'rangeUpdate', [$userId, $monday]);
	}
    }
}

