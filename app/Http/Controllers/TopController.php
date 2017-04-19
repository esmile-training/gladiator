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
	//DB更新
	$this->Model->exec('User', 'createUser');

	//リダイレクト
	return $this->Lib->redirect('mypage', 'index');
    }
}
