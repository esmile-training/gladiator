<?php

namespace App\Http\Controllers;

class GachaController extends BaseGameController 
{
    
	public function select()
	{

		
		return viewWrap('gachaselect', $this->viewData);
	}
	public function eventsSelect()
	{
		$time = $this->Model->exec('Gacha', 'getTime',$this->user['id']);
		$createTime = $time[0]['createTime'];
		$this->viewData['createTime'] = $createTime;
		$this->viewData['nowTime'];

		return viewWrap('eventsGachaselect', $this->viewData);
	}
	public function roadScreen()
	{
		//$this->viewData = array();
		//リダイレクトのゲットしてビューデーターに格納
		(int)$this->viewData['gacha']['gachavalue'] = filter_input(INPUT_GET, "gachavalue");
		$this->viewData['gacha']['charaId'] = filter_input(INPUT_GET, "charaId");
		$this->viewData['gacha']['firstname'] = filter_input(INPUT_GET, "firstname");
		$this->viewData['gacha']['lastname'] = filter_input(INPUT_GET, "lastname");
		$this->viewData['gacha']['rarity'] = filter_input(INPUT_GET, "rarity");
		$this->viewData['gacha']['gu'] = filter_input(INPUT_GET, "gu");
		$this->viewData['gacha']['choki'] = filter_input(INPUT_GET, "choki");
		$this->viewData['gacha']['paa'] = filter_input(INPUT_GET, "paa");
		$this->viewData['gacha']['hp'] = filter_input(INPUT_GET, "hp");

		return viewWrap('gachaRoad', $this->viewData);
	}
	public function index() 
	{
		//リダイレクトのゲットしてビューデーターに格納
		(int)$this->viewData['gachavalue'] = filter_input(INPUT_GET, "gachavalue");
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
		
		if($this->user['money']  < 0)
		{
			return view('error');
		}
		
		$this->Lib->exec('Money', 'Subtraction', array($this->user, $gachaConfig[$gachaVal]['money']));
		
		//ガチャの選択して割合算出
		$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio');

		$ratio = $this->viewData['ratio']['hit'];
		
		//キャラの画像ID取得
		if($gachaVal == 7)
		{
			$sex = 1;
		}else if($gachaVal == 5){
			$sex = 0;
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
			'GachaVal' => $gachaVal,
		];
		
		//リダイレクト引数受け渡し
		$param = [
			'gachavalue' => $gachaVal,
			'charaId' => $charaData['uCharaId'],
			'firstname' => $charaData['uCharaFirstName'],
			'lastname' => $charaData['uCharaLastName'],
			'rarity' => $ratio,
			'gu' => $charaData['gu'],
			'choki' => $charaData['choki'],
			'paa' => $charaData['paa'],
			'hp' => $charaData['hp'],
		];

		$this->Model->exec('Gacha', 'createChara', array($charaData));
		
		$this->Model->exec('Gacha', 'createLog', array($charaData));
	
		return $this->Lib->redirect('gacha','roadScreen', $param);
		
	}
}

