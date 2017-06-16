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
		$type	 = filter_input(INPUT_GET,"type");
		$objId	 = filter_input(INPUT_GET,"objId");
		$cnt	 = filter_input(INPUT_GET,"cnt");
		
		if($receiveId != 0)
		{
			switch ($type)
			{
				case 1:
					$this->Model->exec('Chara','charaAcceptFlag',$objId);
					break;
				
				case 2:
					$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
					$this->itemData			= \Config::get('item.itemStr');
					$updateItemData = $this->Lib->exec('Belongings','updateItem',array($objId,$cnt,$this->itemData,$this->belongingsData,$this->user));
					// DBの更新
					$this->Model->exec('Item', 'updateItemData', array($updateItemData));
					break;
				
				case 3:
					// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
					$this->Lib->exec('Money', 'addition', array($this->user, $cnt));
					break;
				
				default:
					break;
			}
			$this->Model->exec('presentbox','changeDelFlag',$receiveId);
		}
		else
		{
			$presentData = $this->Model->exec('PresentBox','getById', $this->user['id']);
			foreach($presentData as $val)
			{
				$receiveData['uPresentId'][]	= $val['id'];
				$receiveData['type'][]			= $val['type'];
				$receiveData['objId'][]			= $val['objId'];
			}
			$this->Lib->exec('presentbox','test',array($receiveData));
		}
		
		//リダイレクト
		return $this->Lib->redirect('presentbox', 'index');
	}
}