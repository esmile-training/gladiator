<?php

namespace App\Http\Controllers;

class GachaController extends BaseGameController {
	
	public function index() {
	
		$this->viewDataSet();
		$this->dataBaseSet();
		return viewWrap('gacha', $this->viewData);
		
	}
	public function viewDataSet(){
		
		//ガチャの選択して割合算出
		$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio');
		
		$ratio = $this->viewData['ratio'];
	
		//キャラの画像ID取得
		$this->viewData['chara'] = $this->Lib->exec('RandamChara', 'getCharaImgId');

		//性別データの格納
		$sexData = $this->viewData['chara']['sex'];
		
		//$this->viewData['womanchara'] = $this->Lib->exec('RandamChara', 'womanCharaSort');
		
		//キャラのステータス
		$this->viewData['valueList'] = $this->Lib->exec('RandamChara', 'getValueConf',$ratio);

		//キャラネーム 
		$this->viewData['name'] = $this->Lib->exec('RandamChara', 'randamCharaName', [$sexData]);
		
	}
	public function dataBaseSet(){
				
		$this->viewDataSet();
				
		//DBへの受け渡し
		$uCharaId = $this->viewData['chara']['charaId'];
		$uCharaFirstName = $this->viewData['name']['firstname']['name'];
		$uCharaLastName = $this->viewData['name']['lastname']['familyname'];
		$ratio = $this->viewData['ratio'];
		$atk1 = $this->viewData['valueList']['atk1'];
		$atk2 = $this->viewData['valueList']['atk2'];
		$atk3 = $this->viewData['valueList']['atk3'];
		$hp = $this->viewData['valueList']['hp'];
		$narrow = $this->viewData['valueList']['narrow'];
		
		$this->Model->exec('User', 'createChara', array($uCharaId, $uCharaFirstName, $uCharaLastName,$ratio, $narrow, $hp, $atk1, $atk2, $atk3));
	}
}

