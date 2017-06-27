<?php
namespace App\Http\Controllers;

class PresentboxController extends BaseGameController
{
	public function index()
	{
		//受け取りボックスのデータ取得
		$this->viewData['presentData'] = $this->Model->exec('Presentbox','getById', $this->user['id']);
		$this->viewData['itemData']	= \Config::get('item.itemStr');
		//ビューに渡す
		return viewWrap('Presentbox',$this->viewData);
	}
	
	public function setPresentData()
	{
		//receiveId,type,objId,cntをviewからGET
		$receiveId = filter_input(INPUT_GET,"receiveId");
		$type	 = filter_input(INPUT_GET,"type");
		$objId	 = filter_input(INPUT_GET,"objId");
		$cnt	 = filter_input(INPUT_GET,"cnt");
		
		//受け取りボックスのデータ取得
		$presentData = $this->Model->exec('Presentbox','getById', $this->user['id']);
		// キャラ所持数の最大値と現在値を取得する
		$charaInventory = array();
		$charaInventory['upperLimit'] = $this->Lib->exec('ManageCharaPossession','getUpperLimitChara',$this->user['id']);
		$charaInventory['possession'] = $this->Lib->exec('ManageCharaPossession','getPossessionChara',$this->user['id']);
		
		//reciveIdが0だった場合一括受け取り
		if($receiveId != 0)
		{
			switch ($type)
			{
				case 1:
					if($charaInventory['upperLimit'] >= $charaInventory['possession'])
					{
						$this->Model->exec('Chara','charaAcceptFlag',$objId);
						$this->Model->exec('presentbox','changeDelFlag',$receiveId);
						// 所持キャラ数の加算を行う
						$this->Lib->exec('ManageCharaPossession','addPossessionChara',array($this->user));
					}
					break;
				
				case 2:
					$this->belongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
					$this->itemData			= \Config::get('item.itemStr');
					$updateItemData = $this->Lib->exec('Belongings','updateItem',array($objId,$cnt,$this->itemData,$this->belongingsData,$this->user));
					// DBの更新
					$this->Model->exec('Item', 'updateItemData', array($updateItemData));
					$this->Model->exec('presentbox','changeDelFlag',$receiveId);
					break;
				
				case 3:
					// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
					$this->Lib->exec('Money', 'addition', array($this->user, $cnt));
					$this->Model->exec('presentbox','changeDelFlag',$receiveId);
					break;
				
				default:
					break;
			}
		}else{
			$cnt = 0;
			foreach($presentData as $val)
			{
				$receiveData[$cnt]['id']	= $val['id'];
				$receiveData[$cnt]['type']	= $val['type'];
				$receiveData[$cnt]['objId']	= $val['objId'];
				$receiveData[$cnt]['cnt']	= $val['cnt'];
				$cnt++;
			}
			$this->Lib->exec('presentbox','receiveAll',array($this->user,$receiveData,$charaInventory));
		}
		
		//リダイレクト
		return $this->Lib->redirect('presentbox', 'index');
	}
}