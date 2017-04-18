<?php

namespace App\Http\Controllers;

class sampleController extends BaseGameController
{
     public static function index()
    {  

	$name = htmlspecialchars($_GET["username"]);
	 
	//クッキーの存在の有無と同一ユーザーであるか
	if(!isset($_COOKIE['username']) || $_COOKIE['username'] != $name)
	{
	    //DB検索して存在するユーザーか調べる
	    $sql =  <<< EOD
	SELECT *
	FROM user
	WHERE id = {$name}
EOD;
	    //$kekka = \App\Model\BaseGameModel::dbapi($sql, 'update');
	    //echo ($kekka);
	    setcookie('username', $name , 0);
	}
	
	//セッションの存在の有無と同一ユーザーであるか
	if(!isset($_SESSION['username']) || $_SESSION['username'] != $name)
	{
	    //DB検索して存在するユーザーか調べる
	    session_start();
	    $_SESSION['username'] = $name;
	}
	
	//DB更新
	$this->Model->exec('User', 'createUser');

	//リダイレクト
	return $this->Lib->redirect('omikuji', 'index');
		
	//return view('omikuji');
    }
}
