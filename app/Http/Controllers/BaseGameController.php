<?php
namespace App\Http\Controllers;

class BaseGameController extends Controller
{
    public $viewData;

    public function __construct()
    {
	//BaseGameLibをセット
	$this->Lib = new \App\Libs\BaseGameLib();
	//BaseGameModelをセット
	$this->Model = new \App\Model\BaseGameModel();

	//ユーザ認証しないコントローラ
	if( in_array(CONTROLLER_NAME, \Config::get('common.ignoreAuthController')) ){
	    return;
	}
	//ユーザー認証
	$userId = 32; //cookieから取ってくる
	$commonData['user'] =  $this->Lib->exec('User', 'userAuth', false, $userId); 

	//現在時刻をセット
	$commonData['nowTime'] = ( is_null($commonData['user']['debugDate']) )?date('Y-m-d H:i:s', time()) : $commonData['user']['debugDate'];

	//汎用変数をセット
	foreach( $commonData as $key => $val ){
	    $this->viewData[$key] = $this->$key = $val;
	}

    }

}