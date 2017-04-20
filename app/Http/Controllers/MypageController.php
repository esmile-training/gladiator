<?php
namespace App\Http\Controllers;

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
	    $this->viewData['getuser'] = $this->Model->exec('CharData', 'getByChar', [$cookie]);
	    
	    
	    return viewWrap('mypage', $this->viewData);
	}
}

