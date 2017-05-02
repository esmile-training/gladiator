<?php

namespace App\Libs;

class RandamCharaLib extends BaseGameLib {
	
	public static function getGachaRatio() {
		
		//ガチャの選択
		
		$gachavalue = (int)filter_input(INPUT_GET,"gachavalue");

		//ガチャのレア度ごとの割合
		$gachaConf = \Config::get('gacha.eRate');
		
		//初期化
		$sumper=0;
		//パーセントの合計値
		for($i=1;$i	<= count($gachaConf[$gachavalue]['persent']);$i++){

			$sumper += $gachaConf[$gachavalue]['persent'][$i];	

		}
		//０からパーセント合計値のランダム
		$hitrand = rand(0,$sumper);
		
		$per = 0;
		//合計値を低いパーセントから比較していく
		for($i = 1;$i <= 5; $i++){

			$per += $gachaConf[$gachavalue]['persent'][$i];
			$hit = $i;
			if($hitrand < $per){break;}

		}
		$ratio['hit'] = $hit;
		$ratio['gachavalue'] = $gachavalue;
		
		return $ratio;
	}		
	public function getCharaImgId($sex = false) {
		
		if($sex == 1 ){
			
			return $this->womanCharaSort();
		
		} else {
			
			//configからデータ取ってくる
			$charaConf = \Config::get('chara.imgId');
			//ランダム処理
			$charaId = rand(1, count($charaConf));
			//ランダムできまった数値を配列に入れる
			$charaConf['charaId'] = $charaId;
			//ランダムで決まったキャラの性別も配列に入れる
			$charaConf['sex'] = $charaConf[$charaId]['sex'];
			return $charaConf;
		}
	}

	public static function getValueConf($ratio) {
		
		$gachaV = (int)filter_input(INPUT_GET,"gachavalue");
		//configからデータ取ってくる
		$gachaConf = \Config::get('gacha.eRate');
		if(!$gachaConf[$gachaV]['Status'] == null){
			
			$valueListConf = $gachaConf[$gachaV]['Status'];
		
		} else {
		
			//configからデータ取ってくる
			$valueListConf = \Config::get('chara.Status');
		
		}
		
		
		foreach($valueListConf as $value){
			//一つ目の攻撃力の処理
			$ratio1 = mt_rand($valueListConf[$ratio]['valueMin'], $valueListConf[$ratio]['valueMax']) * 0.01;
			$atk1 = $valueListConf[$ratio]['sumValueMax'] * $ratio1;
			//二つ目の攻撃力の処理
			if ($ratio1 * 100 < 100) {
				$valueListConf[$ratio]['valueMin'] += abs($ratio1 * 100 - 100);
			} else if ($ratio1 * 100 > 100) {
				$valueListConf[$ratio]['valueMax'] -= abs($ratio1 * 100 - 100);
			}
			$ratio2 = mt_rand($valueListConf[$ratio]['valueMin'], $valueListConf[$ratio]['valueMax']) * 0.01;
			$atk2 = $valueListConf[$ratio]['sumValueMax'] * $ratio2;

			//三つ目の攻撃力の処理
			$atk3 = $valueListConf[$ratio]['sumValueMax'] * 3 - ($atk1 + $atk2);

			//型キャスト
			$valueListConf['atk1'] = (int) $atk1;
			$valueListConf['atk2'] = (int) $atk2;
			$valueListConf['atk3'] = (int) $atk3;
			$valueListConf['hp'] = $valueListConf['atk1'] + $valueListConf['atk2'] + $valueListConf['atk3'];
			if ($valueListConf['hp'] <= $valueListConf[$ratio]['sumValueMax'] * 3 - 1) {

				$valueListConf['hp'] += 1;
			}

			$narrow = 0;
			//特化型
			if ($atk1 > $atk2 && $atk1 > $atk3) {
				$narrow = 1;
			} else if ($atk2 > $atk1 && $atk2 > $atk3) {
				$narrow = 2;
			} else {
				$narrow = 3;
			}
			$valueListConf['narrow'] = $narrow;
			
			if($gachaV == 6 && $narrow == 1){break;}
		}
		
		return $valueListConf;
	}

	public static function randamCharaName($sexData) {

		//configからデータ取ってくる
		$charanameConf = \Config::get('chara.allname');
		//ファーストネーム配列の中からひとつランダムで取る
		$charaFirstNameNumber = array_rand($charanameConf['firstname'][$sexData]);
		//ラストネーム
		$charaLastNameNumber = array_rand($charanameConf['lastname']);
		$charanameConf['firstname'] = $charanameConf['firstname'][$sexData][$charaFirstNameNumber];
		$charanameConf['lastname'] = $charanameConf['lastname'][$charaLastNameNumber];

		return $charanameConf;
		
	}
	public function womanCharaSort() 
	{		
		//configからデータ取ってくる
		$characonf = \Config::get('chara.imgId');
	
		$charawoman = [];
		foreach ($characonf as $key => $value) {
			if($value['sex'] == 1){
				$charawoman[] = $key;//配列に直す方法模索
			}
		}
		$womanCharaId = array_flip($charawoman);//キーと入れ替え
		//ランダム処理
		$charaId = array_rand($womanCharaId);
		//ランダムできまった数値を配列に入れる
		$characonf['charaId'] = $charaId;
		//ランダムで決まったキャラの性別も配列に入れる
		$characonf['sex'] = 1;
		
		return $characonf;
	}
	
}
