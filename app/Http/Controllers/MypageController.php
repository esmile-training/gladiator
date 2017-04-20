<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
	public function index()
	{

	    $this->viewData['user'] = 1;
	    // DB接続
	    $this->viewData['getuser'] = $this->Model->exec('CharData', 'getByChar', $this->viewData['user']);
	    
	    
	    return viewWrap('mypage', $this->viewData);
	}
}

