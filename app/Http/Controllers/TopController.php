<?php

namespace App\Http\Controllers;
//Lib
use App\Libs\DevelopMemberLib;

class TopController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {

        //configからとってくる
        $membersConf          =   \Config::get('members.profile');

        //Libraly
        $this->viewData['memberList'] = DevelopMemberLib::sortMemberConf( $membersConf );

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
    	$param = [
	    'uid' => \Request::input('uid'),
	    'loginCheck' => true,
	 ];
	//exit;

	//リダイレクト
	return $this->redirect('mypage', 'index', $param);
    }
}