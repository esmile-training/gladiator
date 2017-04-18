<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
<<<<<<< HEAD
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
=======
    public function index()
    {
		return viewWrap('mypage', $this->viewData);
    }

}
>>>>>>> remotes/origin/kobayashi_baseInstance
