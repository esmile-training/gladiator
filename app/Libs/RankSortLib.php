<?php
namespace App\Libs;

class RankSortLib extends BaseGameLib
{
    public function ranksort( $inputrank, $userId )
    {
	// $rankchange = filter_input(INPUT_COOKIE, 'rankchange');

	// DB接続
	$getrank = $this->Model->exec('Ranking', 'getByrank', $userId);
	$sortrank = [];
	
	// 
	$userrank = array_search($userId, array_column($getrank, 'userId'));

	// ランキング取得時、中間ではなく、上位十位以内だった場合
	if($getrank[11]['userId'] != $userId && 10 > $userrank){
	    echo 'no';
	}

	//arsort($sortrank, SORT_NUMERIC);
	
	//var_dump($sortrank);
	
	return $sortrank;
    }
}

