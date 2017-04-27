<?php
namespace App\Libs;

class BaseGameLib
{
    
    public $user;
    
    public function __construct()
    {
	//BaseGameLibをセット
	$this->Lib =$this;
	//BaseGameModelをセット
	$this->Model = new \App\Model\BaseGameModel();
    }

    /*
     * lib呼び出し
     */
    public function exec( $className, $method, $arg = false, $userId = null )
    {
	//インスタンス化する
	$className = '\\App\\Libs\\'.$className.'Lib';
	$libClass = new $className();

	//ユーザ情報がある場合は登録
	if( $userId ){
	    $userLib = new UserLib();
	    $libClass->user = $userLib->getUser( $userId );
	}else{
	    $libClass->user = null;
	}

	//引数の数によって出しわけ
	if( is_array($arg) ){
	    $result = call_user_func_array( array($libClass , $method), $arg );
	}elseif( $arg ){
	    $result =  call_user_func_array( array($libClass , $method), array($arg) );
	}else{
	    $result = $libClass->$method( );
	}
	return $result;
    }
    /**
     * GETリダイレクトさせる
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