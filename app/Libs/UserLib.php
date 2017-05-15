<?php
namespace App\Libs;

class UserLib extends BaseGameLib
{
    /*
     * ユーザ認証
     */
    public function userAuth()
    {
	$userData = $this->getUser($this->user['id'] );

	//DBに情報がなければユーザ作成
	//if( !$userData ) $this->redirect('top', 'login');
	//DBに情報がなければエディット画面に移動
	if( !$userData ) $this->redirect('edit');
	return $userData;
    }

    /*
     * ユーザ認証
     */
    public function getUser( $userId )
    {
	$userData = $this->Model->exec('User', 'getById', false, $userId);
	return $userData;
    }
	
}