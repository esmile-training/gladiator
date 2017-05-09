<?php
namespace App\Http\Controllers;

class MypageController extends BaseGameController
{
    public function index()
    {
		$trainingInfo = $this->Lib->exec('Training', 'endCheck', $this->viewData['nowTime']);
		
		if(isset($trainingInfo))
		{
			echo('訓練が完了した剣闘士がいます！');
		}
		
		return viewWrap( 'mypage', $this->viewData);
	}
}
