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
	
		$this->viewData['charaId'] = filter_input(INPUT_GET, "charaId");
		$this->viewData['firstname'] = filter_input(INPUT_GET, "firstname");
		$this->viewData['lastname'] = filter_input(INPUT_GET, "lastname");
		$this->viewData['rarity'] = filter_input(INPUT_GET, "rarity");
		$this->viewData['gu'] = filter_input(INPUT_GET, "gu");
		$this->viewData['choki'] = filter_input(INPUT_GET, "choki");
		$this->viewData['paa'] = filter_input(INPUT_GET, "paa");
		$this->viewData['hp'] = filter_input(INPUT_GET, "hp");

		return viewWrap('gacha', $this->viewData);
	}

	public function viewDataSet()
	{
		//ガチャのレア度ごとの割合
		$gachaConfig = \Config::get('gacha.eRate');
		
		$gachaVal = (int)filter_input(INPUT_GET,"gachavalue");
		$this->Lib->exec('Money', 'Subtraction', array($this->user, $gachaConfig[$gachaVal]['money']));
		
		//ガチャの選択して割合算出
		$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio');
	
		$ratio = $this->viewData['ratio']['hit'];

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
		$charaData = [
		'userId' => $this->viewData['user']['id'],
		'uCharaId' => $this->viewData['chara']['charaId'],
		'uCharaFirstName' => $this->viewData['name']['firstname']['name'],
		'uCharaLastName' => $this->viewData['name']['lastname']['familyname'],
		'ratio' => $ratio,
		'gu' => $this->viewData['valueList']['gu'],
		'choki' => $this->viewData['valueList']['choki'],
		'paa' => $this->viewData['valueList']['paa'],
		'hp' => $this->viewData['valueList']['hp'],
		'narrow' => $this->viewData['valueList']['narrow'],
		];
		
		$param['charaId'] = $charaData['uCharaId'];
		$param['firstname'] = $charaData['uCharaFirstName'];
		$param['lastname'] = $charaData['uCharaLastName'];
		$param['rarity'] = $ratio;
		$param['gu'] = $charaData['gu'];
		$param['choki'] = $charaData['choki'];
		$param['paa'] = $charaData['paa'];
		$param['hp'] = $charaData['hp'];
		$this->Model->exec('User', 'createChara', array($charaData));
		return $this->Lib->redirect('gacha','index', $param);
		// return $this->Lib->redirect('gacha', 'index');
	}

//	public function gachaResult()
//	{
//			// [ user.php ]
//			$charaId = filter_input(INPUT_GET, "charaId") ;
//			var_dump($charaId);exit;
//	}
	
}

