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
		$this->viewData['deck'] = $this->Lib->exec('RandamChara', 'checkEventGachaMonth', $this->user['id']);

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
		$this->viewData['gacha']['limit'] = filter_input(INPUT_GET, "limit");

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
		$this->viewData['limit'] = filter_input(INPUT_GET, "limit");
		return viewWrap('gacha', $this->viewData);
	}

	public function viewDataSet()
	{
		//ガチャのレア度ごとの割合
		$gachaConfig = \Config::get('gacha.eRate');

		//ガチャの種類取得
		$gachaVal = (int)filter_input(INPUT_GET,"gachavalue");

		//プレイヤーの所持金が1以上か
		if($this->user['money']  < 0)
		{
			return view('error');
		}

		//所持金の減算処理
		$this->Lib->exec('Money', 'Subtraction', array($this->user, $gachaConfig[$gachaVal]['money']));

		//ガチャの選択して割合算出
		$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio');

		//
		$ratio = $this->viewData['ratio']['hit'];

		//ボックスガチャの場合レア度を上書きする
		if($gachaVal == 14)
		{
			$ratio = $this->Lib->exec('RandamChara', 'boxGachaData', [$this->user['id'],$gachaConfig[$gachaVal]]);
		}

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
			'limit' => '0',
		];

		// 所持キャラが最大かどうかのフラグ
		$maxPossessionFlag = $this->Lib->exec('ManageCharaPossession','checkUpperLimit',array($this->user));

		// 所持キャラ枠に空きがあるか
		if($maxPossessionFlag != true)
		{
			// 所持キャラ枠に空きがあれば通常のcreateCharaを実行する
			$this->Model->exec('Gacha', 'createChara', array($charaData));
			// 所持キャラ数の加算を行う
			$this->Lib->exec('ManageCharaPossession','addPossessionChara',array($this->user));
		}
		else
		{
			// 空きが無ければ未取得状態のキャラを生成する
			$id = $this->Model->exec('Gacha', 'createUnacquiredChara', array($charaData));
			// プレゼントボックスへデータを受け渡す
			$this->Model->exec('Presentbox','insertPresentData',array($this->user['id'],'1',$id,$charaData['uCharaId'],'1'));
			// 上限達したかをparamに持たせる
			$param['limit'] = '1';
		}

		// ログの作成を実行する
		$this->Model->exec('Gacha', 'createLog', array($charaData));

		return $this->Lib->redirect('gacha','roadScreen', $param);

	}
}
