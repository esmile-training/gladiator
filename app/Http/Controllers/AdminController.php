<?php

namespace App\Http\Controllers;
//Model
use App\Model\UserModel;
//Lib
use App\Libs\DevelopMemberLib;

class AdminController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {
        //Libraly
        $this->viewData['memberList'] = DevelopMemberLib::sortMemberConf();

        return viewWrap('admin', $this->viewData);
    }
    /*
     * ユーザ編集
     */
    public function editUser()
    {exit;
	//ユーザ存在確認
	$userId = \Request::input('userId');
	$user = UserModel::getById( $userId );
	if( !$user ) return $this->redirect('admin');
	
	//名前変更の場合
	if( \Request::input('rename') ){
	    $newName = \Request::input('newName');
	    if( !$newName ) return $this->redirect('admin');
	     UserModel::setUserName( $userId, $newName );
	}
	
	//ユーザ削除の場合
	if( \Request::input('delete') ){
	    UserModel::deleteUser( $userId );
	}

	//リダイレクト
	return $this->redirect('admin');
    }
}