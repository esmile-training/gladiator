<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class MypageController extends BaseGameController
{
	public function index()
	{
	    setcookie('id', '1');
	    
	    // cookieを代入
	    $cookie = filter_input(INPUT_COOKIE, "id");
	    
	    // cookieの確認
	    isset($cookie) ? true : exit();
	    
	    // DB接続
	    $get['getuser'] = UserModel::getByChar($cookie);
	    
	    return view('mypage', $get);
	}
}