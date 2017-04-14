<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class BaseGameController extends Controller
{
    public function __construct()
    {
	//TOPコントローラはユーザ認証しない。
	if( CONTROLLER_NAME == 'top' ){
	    return;
	}

	//ユーザーの情報をセット
	$userId = 34; //TODO: cookie取ってくる
	$commonData['user'] = UserModel::getById( $userId );

	//DBに情報がなければユーザ作成
	if( !$commonData['user'] ) $this->redirect('top', 'login');

	//現在時刻をセット
	$commonData['nowTime'] = ( is_null($commonData['user']['debugDate']) )?date('Y-m-d H:i:s', time()) : $commonData['user']['debugDate'];

	//汎用変数をセット
	foreach( $commonData as $key => $val ){
	    $this->viewData[$key] = $this->$key = $val;	    
	}

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