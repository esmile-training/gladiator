<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class RankingController extends BaseGameController
{
	public function index()
	{
	    setcookie('id', '1');
	    
	    // cookieを代入
	    $cookie = filter_input(INPUT_COOKIE, "id");
	    
	    // cookieの確認
	    isset($cookie) ? true : exit();
	    
	    // DB接続
	    $getrank = UserModel::getByrank();
	    $sortrank = [];
	    $ranknum = 0;
	    
	    
	    foreach ($getrank as $value) {
		$sortrank[$value['uname']] = $value['upoint'];
	    }

	    arsort($sortrank, SORT_NUMERIC);
	    
	    //$rank['rank'] = $sortrank;
	    
	    foreach ($sortrank as $key => $value) {
		$sortrank[$key] = [$value, ++$ranknum];
	    }
	    $rank['rank'] = $sortrank;
	    var_dump($rank);
	    
	    
	    
	    return view('ranking', $rank);
	}
}