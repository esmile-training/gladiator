<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class BaseGameController extends Controller
{
    public function __construct()
    {
	//ユーザーの情報をセット
	$userId = 26; //TODO: cookie取ってくる
	$this->viewData['userDb'] = $this->userDb = UserModel::getById( $userId );

	//DBに情報がなければユーザ作成
	if( !$this->userDb ) $this->redirect('login', 'createUser');

	//現在時刻をセット
	$this->viewData['nowTime'] =$this->nowTime = ( is_null($this->userDb['debugDate']) )?date('Y-m-d H:i:s', time()) : $this->userDb['debugDate'];
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