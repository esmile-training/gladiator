<?php

namespace App\Http\Controllers;

class GachaController extends BaseGameController 
{
    
	public function select()
	{
		return viewWrap('gachaselect', $this->viewData);
	}
	
	public function index() 
	{
		$this->viewDataSet();
		//$charaId = filter_input(INPUT_GET, "charaId") ;
		//var_dump($charaId);exit;
		
		return viewWrap('gacha', $this->viewData);
	}

	public function viewDataSet()
	{
		
		//ガチャの選択して割合算出
		$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio');
		
		$ratio = $this->viewData['ratio']['hit'];
	
		
		$gachaVal = (int)filter_input(INPUT_GET,"gachavalue");

		//キャラの画像ID取得
		if($gachaVal == 7){
			$sex = 1;
		}else{
			$sex = false;
		}
	
		$this->viewData['chara'] = $this->Lib->exec('RandamChara', 'getCharaImgId', [$sex]);
		
		//キャラのステータス
		$this->viewData['valueList'] = $this->Lib->exec('RandamChara', 'getValueConf',$ratio);

		//性別データの格納
		$sexData = $this->viewData['chara']['sex'];
		
		//キャラネーム 
		$this->viewData['name'] = $this->Lib->exec('RandamChara', 'randamCharaName', [$sexData]);
		
		//DBへの受け渡し
		$userId = $this->viewData['user']['id'];
		$uCharaId = $this->viewData['chara']['charaId'];
		$uCharaFirstName = $this->viewData['name']['firstname']['name'];
		$uCharaLastName = $this->viewData['name']['lastname']['familyname'];
		$atk1 = $this->viewData['valueList']['atk1'];
		$atk2 = $this->viewData['valueList']['atk2'];
		$atk3 = $this->viewData['valueList']['atk3'];
		$hp = $this->viewData['valueList']['hp'];
		$narrow = $this->viewData['valueList']['narrow'];

		
		//$param['charaId'] = $this->Model->exec('User', 'createChara', array($userId,$uCharaId,$uCharaFirstName,$uCharaLastName,$ratio,$narrow,$hp,$atk1,$atk2,$atk3));
		$this->Model->exec('User', 'createChara', array($userId,$uCharaId,$uCharaFirstName,$uCharaLastName,$ratio,$narrow,$hp,$atk1,$atk2,$atk3));
		//return $this->Lib->redirect('gacha','index', $param);
		// return $this->Lib->redirect('gacha', 'index');
	}

//	public function gachaResult()
//	{
//			// [ user.php ]
//			$charaId = filter_input(INPUT_GET, "charaId") ;
//			var_dump($charaId);exit;
//	}
	
}

