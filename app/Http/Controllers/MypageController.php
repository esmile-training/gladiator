<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib

class MypageController extends BaseGameController
{
    public function index()
    {
	return viewWrap('mypage', $this->viewData);
    }

    /*
     * ユーザ削除
     */
    public function setUserName()
    {
	//ユーザ存在確認
	$userId = \Request::input('userId');
	$user = UserModel::getById( $userId );
	
	if( $user ){
	    UserModel::setUserName( $userId, \Request::input('newName') );
	}

	//リダイレクト
	return $this->redirect('mypage');
    }
}
