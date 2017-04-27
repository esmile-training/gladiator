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
	    $this->Model->exec('User' , 'getById' , "" , $_COOKIE['userId']);
	    
	    $battleFlag = null;	//$this->Model->exec('User' , 'getBattleFlag' , "" , $_COOKIE['userId']);
	    if($battleFlag['delFlag'] === "0"){
			//試合中
			//ユーザーに処理を聞く//ポップアップ
			return viewWrap('Error');
	    } else {
			//リダイレクト
			return $this->Lib->redirect('mypage', 'index');
	    } 
	}
	else 
	{
	    //無ければエディット画面にリダイレクトする。
	    return $this->Lib->redirect('edit');
	}
    }
}
