<?php
namespace App\Http\Controllers;

class AdminController extends BaseGameController
{
    /**
     * TOP画面表示
     * 
     */
    public function index()
    {
        //Libraly
        $this->viewData['memberList'] = $this->Lib->exec('DevelopMember', 'getMemberConf');
        return viewWrap('admin', $this->viewData);
    }
    /*
     * ユーザ編集
     */
    public function editUser()
    {
	//ユーザ存在確認
	$userId = \Request::input('userId');
	$user = $this->Model->exec('User', 'getById', $userId );
	if( !$user ) return $this->Lib->redirect('admin');
	
	//名前変更の場合
	if( \Request::input('rename') )
	{
	    $newName = \Request::input('newName');
	    if( !$newName ) return $this->Lib->redirect('admin');
	    $this->Model->exec('User', 'setUserName', array($userId, $newName) );
	}
	
	//ユーザ削除の場合
	if( \Request::input('delete'))
	{
	    $this->Model->exec('User', 'deleteUser', $userId );
	}

	//リダイレクト
	return $this->Lib->redirect('admin');
    }
}