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
		$bgNumber = rand(1, 2);
		$this->viewData['bgNumber'] = $bgNumber;
		return view('top',['viewData' => $this->viewData]);
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
		if(!isset($_COOKIE['userId']))
		{
			//無ければエディット画面にリダイレクトする。
			return $this->Lib->redirect('edit');
		} else {
			if($this->Model->exec('BattleInfo', 'getBattleData', "", $_COOKIE['userId'])){
				//バトル中データあり
				//ポップアップ表示予定
				return $this->Lib->redirect('battle', 'battleLog');
			}
		}
		//何もなければマイページヘリダイレクトする
		return $this->Lib->redirect('mypage', 'index');
	}
}
