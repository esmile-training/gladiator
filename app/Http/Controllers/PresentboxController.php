<?php
namespace App\Http\Controllers;

class PresentBoxController extends BaseGameController
{
	public function index()
	{
		$this->viewData['presentData'] = $this->Model->exec('PresentBox','getById', $this->user['id']);
		return viewWrap('Presentbox',$this->viewData);
	}
	
	public function setPresentData()
	{
		$receiveId = filter_input(INPUT_GET,"receiveId");
			
		if($receiveId != 0)
		{
			$type = filter_input(INPUT_GET,"type");
			switch ($type)
			{
				case 1:
					break;
				case 2:
					break;
				case 3:
					break;
				default:
					break;
			}
		}
		else
		{
			$presentData = $this->Model->exec('PresentBox','getById', $this->user['id']);
			foreach($presentData as $val)
			{
				$receiveData['uPresentId'][]	= $val['id'];
				$receiveData['type'][]			= $val['type'];
				$receiveData['objId'][]		= $val['objId'];
			}
			$this->Lib->exec('presentbox','test',array($receiveData));
		}
		
		$this->Model->exec('presentbox','changeDelFlag',$receiveId);
		
		//リダイレクト
		return $this->Lib->redirect('presentbox', 'index');
	}
}