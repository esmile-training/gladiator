<?php

namespace App\Http\Controllers;

class EditController extends BaseGameController
{
    public function index()
    {
	return view('edit');
    }
    
    public function addUser()
    {
	//bladeから入力された内容を取得
	$player = $_GET["teamName"];
	
	//DBにチーム名を追加してidを取得
	$userId = $this->Model->exec('User', 'createUser', false, null, $player);
	
	//取得したIDで消えないCookieを作成
	setcookie('userId',$userId,time() + 60*60*24*365*20, '/');
	var_dump($_COOKIE['userId']);
	
	//マイページヘリダイレクト
	return $this->Lib->redirect('mypage', 'index');
    }
}
