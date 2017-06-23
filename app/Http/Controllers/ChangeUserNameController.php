<?php

namespace App\Http\Controllers;

class ChangeUserNameController extends BaseGameController
{
	public function changeName()
	{
		$teamName = filter_input(INPUT_GET, "teamName");
		$ngFlag = $this->Lib->exec('NgWordChecker','check',$teamName);
		
		if($ngFlag == true)
		{
			return view('outNameEdit');
		}
		
		$this->Model->exec('User','setUserName',array($this->user['id'], $teamName));
		return $this->Lib->redirect('mypage', 'index');
	}
}
