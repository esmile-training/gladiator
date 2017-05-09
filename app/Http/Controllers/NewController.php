<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib
use App\Libs\DevelopMemberLib;

class NewController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {
        //configからとってくる
        $membersConf = \Config::get('members.profile');

        //Libraly
        $this->viewData['memberList'] = DevelopMemberLib::sortMemberConf( $membersConf );

        return viewWrap('new', $this->viewData);
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
		UserModel::createUser();

		//リダイレクト
		return $this->redirect('mypage', 'index');
    }
}