<?php

namespace App\Http\Controllers;

class EditController extends BaseGameController
{
	public function index()
	{
		return view('edit');
	}

	public function addUser()
	{
		//bladeから入力された値を取得
		$teamName = $_GET["teamName"];

		//チーム名をバイトと文字数で判定
		if(strlen($teamName) <= 16 || mb_strlen($teamName) <= 8)
		{   
			
			//DBにチーム名を追加してidを取得
			$userId = $this->Model->exec('User', 'createUser', [$teamName]);
			
			// rankingにデータを追加
			$this->Model->exec('Ranking','insertRankingData',$userId);
			
			//Cookieの値をuserIDに書き換え
			setcookie('userId', $userId, time() + 60*60*24*365*20, '/');

			$gachaValueList = [0=>12,12,13];
			
			foreach($gachaValueList as $value)
			{
				//ガチャの選択して割合算出
				$this->viewData['ratio'] = $this->Lib->exec('RandamChara', 'getGachaRatio',$value);

				$ratio = $this->viewData['ratio']['hit'];
			
			
				$sex = false;
				
				$this->viewData['chara'] = $this->Lib->exec('RandamChara', 'getCharaImgId', [$sex],$value);
				
				
				//キャラのステータス
				$this->viewData['valueList'] = $this->Lib->exec('RandamChara', 'getValueConf',$ratio,$value);
				
				//性別データの格納
				$sexData = $this->viewData['chara']['sex'];

				//キャラネーム 
				$this->viewData['name'] = $this->Lib->exec('RandamChara', 'randamCharaName', [$sexData]);
				
				//DBへの受け渡し
				$charaData = [
				'userId' => $userId,
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
				$this->Model->exec('Gacha', 'createChara', array($charaData));
				
			}
			$this->Lib->exec('WeekRange','rangeState',$userId);

			//初期コーチの作成
			$this->addCoach($userId, 'goo', 0);
			$this->addCoach($userId, 'choki', 1);
			$this->addCoach($userId, 'paa', 2);
			
			//マイページヘリダイレクト
			return $this->Lib->redirect('mypage', 'index');
		} else {
			//文字数がオーバーした場合のポップアップで警告表示予定
			return $this->Lib->redirect('edit');
		}
	}
	
	public function addCoach($userId, $att, $Atk)
	{
		$atkArray = array('50', '50', '50');
		$atkArray[$Atk] = 200;
		$imgdata = $this->Lib->exec('RandamChara', 'getCharaImgId');
		$namedata = $this->Lib->exec('RandamChara', 'randamCharaName', [$imgdata['sex']]);
		$newCoachState = array( 'userId' => $userId,
								'imgId' => $imgdata['charaId'],
								'name' => $namedata['firstname']['name'].'・'.$namedata['lastname']['familyname'],
								'rare' => 1,
								'attribute' => $att,
								'hp' => 300,
								'gooAtk' => $atkArray[0],
								'choAtk' => $atkArray[1],
								'paaAtk' => $atkArray[2]);
		$this->Model->exec('Coach','insertCoach',array($newCoachState));
	}
}
