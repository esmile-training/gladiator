<?php
namespace App\Libs;

class RankSortLib extends BaseGameLib
{
    public function ranksort( $inputrank, $userId )
    {
	// $rankchange = filter_input(INPUT_COOKIE, 'rankchange');
	var_dump($inputrank);
	
	// DB接続
	$getrank = $this->Model->exec('Ranking', 'getByrank', $userId);
	$sortrank = [];
	
	$userrank = array_search($userId, array_column($getrank, 'userId'));
	
	// ランキング取得時、中間ではなく、上位十位以内だった場合
	if($getrank[11]['userId'] != $userId && 10 > $userrank){
	    

	    foreach ($getrank as $key => $value) {
		if($key < 10){
		    $sortrank[$value['name']] = $value;
		}
    	    }
	}

	//arsort($sortrank, SORT_NUMERIC);
	
	return $sortrank;
    }
}

