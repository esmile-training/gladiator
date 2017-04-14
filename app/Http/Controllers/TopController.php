<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
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
	//DB更新
	UserModel::createUser();

	//リダイレクト
	return $this->redirect('mypage', 'index');
    }
    /*
     * ユーザ削除
     */
    public function deleteUser()
    {
	//ユーザ存在確認
	$userId = \Request::input('userId');
	$user = UserModel::getById( $userId );
	
	if( $user ){
	    UserModel::deleteUser( $userId );
	}

	//リダイレクト
	return $this->redirect('top');
    }

}