<?php
namespace App\Libs;

class RankSortLib extends BaseGameLib
{
    public function ranksort( $inputrank )
    {
	$rankchange = filter_input(INPUT_COOKIE, 'rankchange');
	var_dump($rankchange);
	// DB接続
	$getrank = $this->Model->exec('Ranking', 'getByrank', [$inputrank]);
	$sortrank = [];

	//var_dump($getrank);


	foreach ($getrank as $value) {
	    $sortrank[$value['username']] = $value['totalPoint'];
	}

	arsort($sortrank, SORT_NUMERIC);

	var_dump($inputrank);
	
	//$rank['rank'] = $sortrank;

	$duplicationcheck = 0;
	//$count = 0;
	
	foreach ($sortrank as $key => $value) {
	    $sortrank[$key] = [$value, ++$inputrank[0]];
	    $duplicationcheck[$value[1]];
	}
	
	//var_dump($sortrank);
	
	return $sortrank;
    }
}

