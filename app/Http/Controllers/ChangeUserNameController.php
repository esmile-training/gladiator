<?php

namespace App\Http\Controllers;

class ChangeUserNameController extends BaseGameController
{
    public function index()
    {
		return viewWrap('changeUserName', $this->viewData);
	}
	
	public function changeName()
	{
		$teamName = filter_input(INPUT_GET, "teamName");
		$this->Model->exec('User','setUserName',array($this->user['id'], $teamName));
		return $this->Lib->redirect('mypage', 'index');
	}
}
