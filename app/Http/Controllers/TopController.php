<?php
namespace App\Http\Controllers;

class TopController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {
        return viewWrap('top', $this->viewData);
    }

    /**
     * ユーザーIDをチェックしてリダイレクト
     *
     * @param uid
     * @return Redirect
     */
    public function login()
    {
	//cookieの有無を確認
	if(isset($_COOKIE['userId']))
	{
	    //DB更新
	    //$this->Model->exec('User', 'createUser');
	    $this->Model->exec('User' , 'getById' , "" , $_COOKIE['userId']);

	    //リダイレクト
	    return $this->Lib->redirect('mypage', 'index');
	} 
	else 
	{
	    //無ければエディット画面に遷移する。
	    return view('Edit');
	}
    }
}