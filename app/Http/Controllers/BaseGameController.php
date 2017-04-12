<?php

namespace App\Http\Controllers;

class BaseGameController extends Controller
{
    public function __construct()
    {
	$this->nowTime =  time();
	$this->viewData = [];

	$this->userInfo = [
	    'id'	=> "123456",
	    'nowTime'	=> date('Y-m-d H:i:s', time()),
	];
	$this->viewData['userInfo'] = $this->userInfo;
    }
 
    /**
     * GETリダイレクトさせる
     * header関数に懸念事項があるため、jsに処理以降した方が良いかも？
     */
    public function redirect($controller, $action = 'index', $param = [])
    {
	$getStr = [];
	foreach( $param as $key => $val){
	   $getStr[] = $key.'='.$val;
	}
	header( "Location: ".APP_URL.$controller.'/'.$action.'?'.implode('&', $getStr) );
	
	exit();
    }

}