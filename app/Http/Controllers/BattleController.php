<?php
namespace App\Http\Controllers;

// Lib
use App\Libs\BattleLib;

class battleController extends BaseGameController
{
	/*
	* ソート用のデフォルト処理
	*/
	public function index()
	{
		//デフォルト処理
		$type = (!isset($_GET['type']))? 'id' : $_GET['type'];
		$order = (!isset($_GET['order']))? 'ASC' : $_GET['order'];
		return $this->selectBattleChara($type, $order);
	}
	/*
	 *  戦うキャラの選択をする
	 */
	public function selectBattleChara($type, $order)
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];

		if($this->user['battleTicket'] <= 0)
		{
			return viewWrap('notBattleTicket');
		}

		// キャラ所持数の最大値と現在値を取得する
		$charaInventory = array();
		$charaInventory['upperLimit'] = $this->Lib->exec('ManageCharaPossession','getUpperLimitChara',$userId);
		$charaInventory['possession'] = $this->Lib->exec('ManageCharaPossession','getPossessionChara',$userId);
		// viewDataへ格納する
		$this->viewData['charaInventory'] = $charaInventory;

		// 継続中の戦闘があったらbattleLogへリダイレクトする
		$battleInfo = $this->Model->exec('BattleInfo', 'getBattleData', $userId);
		if(isset($battleInfo))
		{
			$this->Lib->redirect('battle', 'battleLog');
		}

		// DBのキャラクターデータを取得する
		$alluChara = $this->Model->exec('Chara', 'getUserChara', $userId);

		// DBからキャラクターを取得できたかを確認する
		if(isset($alluChara))
		{
			//ソート関数の代に引数への変換
			$order = ($order == 'ASC')? false : true;
			//並べ替え処理
			$alluChara = $this->Lib->exec('Sort','sortArray',[$alluChara, $type, $order]);
			// viewDataへ取得したキャラクターを送る
			$this->viewData['charaList'] = $alluChara;

			// ビューへデータを渡す
			return viewWrap('battleCharaSelect', $this->viewData);
		}
		else
		{
			//キャラクターがいない場合リストを空にして渡す
			$this->viewData['charaList'] = null;
			// ビューへデータを渡す
			return viewWrap('battleCharaSelect',$this->viewData);
		}
	}

	/*
	 *  闘技場の選択をする
	 */
	public function selectArena()
	{
		// ユーザーキャラクターのIDを取得する
		$selectedCharaData = $_GET;
		// 難易度を取得する
		$difficulty = \Config::get('battle.difficultyStr');

		// 対戦の難易度とキャラIDをビューへ渡す
		$this->viewData['difficultyList'] = $difficulty;
		$this->viewData['selectedCharaData'] = $selectedCharaData;

		// ビューへデータを渡す
		return viewWrap('arenaSelect', $this->viewData);
	}

	/*
	 *  戦闘準備(データの取得と構築)をする
	 */
	public function preparationBattle()
	{
		// 大会の情報を取得する(ユーザーキャラIDと難易度)
		$arenaData = $_GET;

		// 大会情報の取得に成功したか確認する
		if(!isset($arenaData))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}

		// IDと一致するキャラクターをDBから取得する
		$selectedChara = $this->Model->exec('Chara', 'getById', $arenaData["selectedCharaId"]);

		// 正常に取得したかを確認する
		if(!isset($selectedChara))
		{
			// マイページへリダイレクトする
			$this->Lib->redirect('mypage', 'index');
		}

		// エネミーの外見を取得する
		$enemyApp				= $this->Lib->exec('EnemyCreate','getEnemyAppearance');
		// エネミーの名前を生成する
		$enemyName				= $this->Lib->exec('EnemyCreate','creatEnemyName',[$enemyApp['sex']]);
		// エネミー作成のための素材
		$enemyStatusMaterial	= array($selectedChara['hp'],$arenaData["arenaDifficulty"]);
		// エネミーの能力値を取得する
		$enemyStatus			= $this->Lib->exec('EnemyCreate','createEnemyStatus',$enemyStatusMaterial);

		// 対戦データの作成をする
		$matchData = BattleLib::createMatchData($arenaData,$selectedChara,$enemyApp,$enemyName,$enemyStatus);

		// データのインサートを行う
		$this->insertMatchData($matchData);

		// チケットの消費処理を行う
		$this->lossTicket();

		// 戦闘処理へリダイレクトする
		$this->Lib->redirect('battle', 'battleLog');
	}

	/*
	 * 対戦データをDBへ入れる
	 */
	public function insertMatchData($argMatchData)
	{
		// ユーザーIDを取得する
		$userId = $this->user['id'];

		// infoデータを取得する
		$battleInfo = $this->Model->exec('BattleInfo', 'getBattleData', $userId);

		// 対戦データの取得をする
		$matchData = $argMatchData;

		$charaData = \Config::get('chara.imgId');

		$skill = \Config::get('chara.skill');

		$matchData['drawCount'] = $skill[$charaData[$matchData['imgId']]['skill']]['drawCount'];

		// デリートフラグが立っていない、同じIDのデータが登録されていなければインサートを行う
		if(!isset($battleInfo))
		{
			// プレイヤーキャラのデータをインサートする
			$uBattleCharaId = $this->Model->exec('BattleChara','insertBattleCharaData',array($matchData['uCharaId'],$matchData['uHp']
					,$matchData['uGooAtk'],$matchData['uChoAtk'],$matchData['uPaaAtk'],$matchData['drawCount']));

			// エネミーのデータをインサートする
			$uBattleEnemyId = $this->Model->exec('BattleEnemy','insertEnemyData',array($matchData['eImgId'],$matchData['difficulty']
					,$matchData['eFirstName'],$matchData['eLastName'],$matchData['eHp'],$matchData['eGooAtk'],$matchData['eChoAtk'],$matchData['ePaaAtk']));

			// バトルインフォにデータをインサートする
			$this->Model->exec('BattleInfo','insertBattleData',array($userId,$uBattleCharaId,$uBattleEnemyId));

			return true;
		}
		else
		{
			// データが入っていたらfalseを返す
			return false;
		}
	}

	/*
	 * チケットを消費させるファンクション
	 */
	public function lossTicket()
	{
		$this->Lib->exec('Ticket','lossTicket',array($this->user,$this->nowTime));
	}

	/*
	 * バトルログを表示するファンクション
	 */
	public function battleLog()
	{
		// setData関数を呼び出し、データをセット
		$this->getBattleData();

		// バトルデータがなかった場合、エラー画面を表示しホームへ戻す
		if(is_null($this->BattleData))
		{
			return view('error');
		}

		// どちらかのHPが0以下になったらバトル終了フラグを立てる
		if ($this->EnemyData['battleHp'] <= 0 || $this->CharaData['battleHp'] <= 0)
		{
			// BattleData の 'delFlag' を立てる
			$this->BattleData['delFlag'] = 1;
		}

		// 降参費用額計算
		$surrenderCost = $this->Lib->exec('Battle', 'surrenderCostCalc', array($this->CharaData, $this->Commission, $this->DifficultyData, $this->EnemyData));

		// 全てのデータを viewData に渡す
		$this->viewData['userData']			= $this->user;
		$this->viewData['battleData']		= $this->BattleData;
		$this->viewData['charaData']		= $this->CharaData;
		$this->viewData['enemyData']		= $this->EnemyData;
		$this->viewData['type']				= $this->TypeData;
		$this->viewData['result']			= $this->ResultData;
		$this->viewData['itemData']			= $this->ItemData;
		$this->viewData['belongingsData']	= $this->BelongingsData;
		$this->viewData['surrenderCost']	= $surrenderCost;

		return view('battle', ['viewData' => $this->viewData]);
	}

	// リザルト画面を表示するファンクション
	public function battleResult()
	{

		//リダイレクト元からデータをゲットする
		$prize						= filter_input(INPUT_GET, "prize");
		$charaData['name']			= filter_input(INPUT_GET, "name");
		$charaData['skill']			= filter_input(INPUT_GET, "skill");
		$charaData['imgId']			= filter_input(INPUT_GET, "imgId");
		if($prize > 0)
		{
			$charaData['hp']			= filter_input(INPUT_GET, "deaultHp");
			$charaData['gooAtk']		= filter_input(INPUT_GET, "deaultGooAtk");
			$charaData['choAtk']		= filter_input(INPUT_GET, "deaultChoAtk");
			$charaData['paaAtk']		= filter_input(INPUT_GET, "deaultPaaAtk");
			$charaUpData['statusUpCnt']	= filter_input(INPUT_GET, "statusUpCnt");
			$charaUpData['gooUpCnt']	= filter_input(INPUT_GET, "gooAtkUpCnt");
			$charaUpData['choUpCnt']	= filter_input(INPUT_GET, "choAtkUpCnt");
			$charaUpData['paaUpCnt']	= filter_input(INPUT_GET, "paaAtkUpCnt");
			$charaData['feverTimeFlug'] = filter_input(INPUT_GET, "feverTimeFlug");	//追記：フィーバータイム判定用フラグ

			$this->viewData['charaUpData']	= $charaUpData;
		}
		$this->viewData['charaDefaultData']	= $charaData;

		// getRankingData ファンクションを呼び出し、ランキングデータを取得
		$this->getRankingData();

		// リザルト画面に必要なデータを viewData に渡す
		$this->viewData['prize']		= $prize;
		$this->viewData['rankingData']	= $this->RankingData;

		return view('battleResult', ['viewData' => $this->viewData]);
	}

	// データベースからデータをそれぞれの変数に格納するファンクション
	public function getBattleData()
	{
		// config/battle で指定した三すくみの名前を読み込み
		// 1 = 'グー' 2 = 'チョキ' 3 = 'パー' で指定中
		$this->TypeData	= \Config::get('battle.typeStr');

		// config/battle で指定した勝敗結果の名前を読み込み
		// 1(勝ち) 2(負け) 3(あいこ) で指定中
		$this->ResultData = \Config::get('battle.resultStr');

		// config/battle で指定した賞金の歩合を読み込み
		// 'Commission' で指定中
		$this->Commission = \Config::get('battle.prizeStr');

		// config/battle で指定した難易度を読み込み
		// 1(初級)、2(中級)、3(上級) で指定、賞金の補正値(％)、敵の補正値(割合)で設定中
		$this->DifficultyData = \Config::get('battle.difficultyStr');

		// ItemData にアイテムデータを格納
		$this->ItemData = \Config::get('item.itemStr');

		// 所持アイテムデータ取得
		$this->BelongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		// 所持アイテムデータがなければ作成
		if(!isset($this->BelongingsData))
		{
			// uItemにデータを追加
			$this->Model->exec('Item','insertItemData',$this->user['id']);

			// 所持アイテムデータ取得
			$this->BelongingsData	= $this->Model->exec('Item', 'getItemData', $this->user['id']);
		}

		// ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
		// BattleData にバトルデータを格納
		$this->BattleData = $this->Model->exec('BattleInfo', 'getBattleData', $this->user['id']);

		if(isset($this->BattleData))
		{
			// バトルデータを元にuBattleChar(DB)からキャラデータを読み込み
			// ChaaraData に自キャラデータを格納
			$this->CharaData = $this->Model->exec('BattleChara', 'getBattleCharaData', $this->BattleData['uBattleCharaId']);

			// バトルデータを元にuBattleChar(DB)から敵データを読み込み
			// EnemyData に敵キャラデータを格納
			$this->EnemyData = $this->Model->exec('BattleEnemy', 'getBattleEnemyData', $this->BattleData['uBattleEnemyId']);
		}
	}

	// データベースからランキングデータを RankingData に格納するファンクション
	public function getRankingData()
	{
		// ユーザーIDを元に週間のランキングデータを読み込み
		$this->RankingData = $this->Model->exec('Ranking', 'getRankingData', $this->user['id']);

		// ランキングデータがなければ、新しくランキングデータを作成してから読み込み
		if(is_null($this->RankingData))
		{
			$this->Model->exec('Ranking','insertRankingData',$this->user['id']);
			$this->RankingData = $this->Model->exec('Ranking', 'getRankingData', $this->user['id']);
		}
	}

	// バトルデータを更新するファンクション
	public function updateBattleData()
	{
		// setData関数を呼び出し、データをセット
		$this->getBattleData();

		// どちらかのHPが既に0の状態なら、ダメージ処理を行わずリザルト画面へ飛ばす
		if($this->CharaData['battleHp'] <= 0 || $this->EnemyData['battleHp'] <= 0)
		{
			return $this->Lib->redirect('Battle', 'makeResultData');
		}
		// 押されたボタンのデータを Chara の 'hand' に格納
		// 1(グー) / 2(チョキ) / 3(パー) のどれかが入る
		$this->CharaData['hand'] = $_GET["hand"];

		// 敵キャラデータを元に、Enemy の 'hand' を格納
		// 1(グー) / 2(チョキ) / 3(パー) のどれかが入る
		$this->EnemyData['hand'] = BattleLib::setEnmHand($this->EnemyData);

		// 勝敗処理
		// 'win' / 'lose' / 'draw' のどれかが入る
		$result = BattleLib::AtackResult($this->CharaData['hand'], $this->EnemyData['hand']);

		//コンフィグからキャラ情報持ってくる
		$charaSkill	= \Config::get('chara.imgId');
		$skill		= \Config::get('chara.skill');

		if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 8 && $this->BattleData['battleSkillTurn'] < $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['turn'])
		{
			//回復の場合
			$this->CharaData['skill'] = $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['recovery'];
			//自分の回復
			$this->CharaData = BattleLib::damageCalc($this->CharaData);
			$this->CharaData['battleHp'] = BattleLib::charaHeal($this->CharaData['battleHp'],$this->CharaData);

			if($this->CharaData['battleHp'] >= $this->CharaData['hp'])
			{
				$this->CharaData['battleHp'] = $this->CharaData['hp'];
			}
		}

		if($this->CharaData['skillFlag'] == 1)
		{
			$this->BattleData['battleSkillTurn'] += 1;
		}

		// ダメージ処理
		// CharaData の 'result' によって処理を行う
		switch ($result)
		{
			// 1(勝ち) の場合
			case 1:
				// 自キャラデータを元にダメージ量を計算
				$this->CharaData = BattleLib::damageCalc($this->CharaData);
				// 変動したダメージ量を元にダメージ処理後の敵キャラHPを計算
				if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 3)
				{
					$this->CharaData['damage'] = BattleLib::charaDoubleAttack($this->CharaData['damage']);
					$this->CharaData['skillFlag'] = 0;
				}
				$this->EnemyData['battleHp'] = BattleLib::hpCalc($this->CharaData, $this->EnemyData);
				break;

			// 2(負け) の場合
			case 2:
				// 敵キャラデータを元にダメージ量を計算
				$this->EnemyData = BattleLib::damageCalc($this->EnemyData);
				if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 4)
				{
					$this->CharaData['damage'] = $this->EnemyData['damage'];
					$this->EnemyData['battleHp'] = BattleLib::hpCalc($this->CharaData, $this->EnemyData);
					$this->CharaData['skillFlag'] = 0;
					break;
				}
				if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 6 && $this->BattleData['battleSkillTurn'] <= $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['turn'])
				{
					$this->EnemyData['damage'] = 0;
					if($this->BattleData['battleSkillTurn'] >= $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['turn'])
					{
						$this->CharaData['skillFlag'] = 0;
						break;
					}
						break;
				}
				// 変動したダメージ量を元にダメージ処理後の自キャラHPを計算
				$this->CharaData['battleHp'] = BattleLib::hpCalc($this->EnemyData, $this->CharaData);
				break;

			// 3(あいこ) の場合
			case 3:
				if($this->CharaData['drawCount'] > 0)
				{
					$this->CharaData['drawCount'] = $this->CharaData['drawCount'] - 1;
				}else{
					$this->CharaData['drawCount'] = 0;
				}
				// ダメージ処理を行わず抜ける
				break;

			// 4(スキル) の場合
			case 4:
				$this->BattleData['battleSkillTurn'] = 0;
				$this->CharaData['skillFlag'] = 1;
				if($this->CharaData['drawCount'] == 0)
				{
					switch ($charaSkill[$this->CharaData['imgId']]['skill'])
					{
						case 1:
							//敵にダメージ
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
							$this->EnemyData['battleHp'] = BattleLib::enemyGooDamage($this->EnemyData['battleHp'],$this->CharaData);
						break;

						case 2:
							//自分の回復
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
							$this->CharaData['battleHp'] = BattleLib::charaHeal($this->CharaData['battleHp'],$this->CharaData);
						break;
						case 3:
							//グーの攻撃力アップ
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
							$this->CharaData['battleGooAtk'] = BattleLib::atkUp($this->CharaData['battleGooAtk'], $this->CharaData['skill']);

						break;
						case 4:
							//チョキの攻撃力アップ
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
							$this->CharaData['battleChoAtk'] = BattleLib::atkUp($this->CharaData['battleChoAtk'], $this->CharaData['skill']);
						break;
						case 5:
							//パーの攻撃力アップ
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
							$this->CharaData['battlePaaAtk'] = BattleLib::atkUp($this->CharaData['battlePaaAtk'], $this->CharaData['skill']);
						break;
						case 6:
							//二回攻撃の場合
							$this->CharaData = BattleLib::damageCalc($this->CharaData);
						break;
						case 9:
							$this->EnemyData['battleHp'] = BattleLib::enemyDead($this->EnemyData['battleHp']);
						break;
					}
				}
				$this->CharaData['drawCount'] = $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['drawCount'];
				break;
			default;
				exit;
		}
		if($this->CharaData['skillFlag'] == 1 && $this->BattleData['battleSkillTurn'] > $skill[$charaSkill[$this->CharaData['imgId']]['skill']]['turn'])
		{
			 $this->CharaData['battleGooAtk'] = $this->CharaData['gooAtk'];
			 $this->CharaData['battleChoAtk'] = $this->CharaData['choAtk'];
			 $this->CharaData['battlePaaAtk'] = $this->CharaData['paaAtk'];
			 $this->CharaData['skillFlag'] = 0;
		}
		
		// 攻撃力上昇アイテムを使用した状態で入ってきていた場合
		if( $this->CharaData['result'] == 6)
		{
			 $this->CharaData['battleGooAtk'] = $this->CharaData['gooAtk'];
			 $this->CharaData['battleChoAtk'] = $this->CharaData['choAtk'];
			 $this->CharaData['battlePaaAtk'] = $this->CharaData['paaAtk'];
		}
		
		// バトルの勝敗を $this->CharaData['result'] に入れる
		$this->CharaData['result'] = $result;
		
		// バトルキャラデータの更新処理
		// 自キャラデータの更新処理
		$this->Model->exec('BattleChara', 'UpdateBattleCharaData', array($this->CharaData));
		// 敵キャラデータの更新処理
		$this->Model->exec('BattleEnemy', 'UpdateBattleEnemyData', array($this->EnemyData));

		$this->Model->exec('BattleInfo', 'UpdateBattleData', array($this->BattleData));

		if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 1)
		{
			$ran = rand(1,100);
			if($ran <= 50){
				return $this->Lib->redirect('Battle', 'makeResultData');
			}
		}

		return $this->Lib->redirect('Battle', 'battleLog');
	}

	/*
	 * リザルト画面に必要なデータの作成、更新をするファンクション
	 */
	public function makeResultData()
	{
		// getData ファンクションを呼び出し、バトルデータをセット
		$this->getBattleData();
		// getRankingData ファンクションを呼び出し、ランキングデータをセット
		$this->getRankingData();

		// バトルデータがなかった場合、エラー画面を表示しホームへ戻す
		// リザルト画面から戻るボタンで戻り、再度ページをリザルト画面を開かれたときの対策
		if(is_null($this->BattleData))
		{
			return view('error');
		}

		// 敵のHPが0以下の場合(試合全体としてプレイヤーが勝った場合)
		if($this->EnemyData['battleHp'] <= 0)
		{
			// 賞金額計算
			$prize =  BattleLib::prizeCalc($this->EnemyData, $this->Commission, $this->DifficultyData);

			//フィーバータイムか判定
			$flug = BattleLib::checkFeverTime();
			if($flug == 1)
			{
				$prize = $prize * 2;
			}

			// ユーザーの所持金 'money' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Money', 'addition', array($this->user, $prize));
			// ユーザーのウィークリーポイント 'weeklyAward' に賞金額を加算しデータベースに格納
			$this->Lib->exec('Ranking', 'weeklyAdd', array($this->RankingData, $prize));

			// 自キャラ、敵キャラのステータスを元にステータスの強化処理(訓練と同じシステムを使用)
			$gooResult = $this->Lib->exec('Training', 'atkUpProbability', array($this->EnemyData['gooAtk'],$this->CharaData['gooAtk'],$this->CharaData['gooUpCnt']));
			$choResult = $this->Lib->exec('Training', 'atkUpProbability', array($this->EnemyData['choAtk'],$this->CharaData['choAtk'],$this->CharaData['choUpCnt']));
			$paaResult = $this->Lib->exec('Training', 'atkUpProbability', array($this->EnemyData['paaAtk'],$this->CharaData['paaAtk'],$this->CharaData['paaUpCnt']));
			$time=1;
			$charaUpData = $this->Lib->exec('Training','atkUpJudge',array($gooResult,$choResult,$paaResult,$time));

			// キャラの強化後の値をデータベースに格納
			$upDateStatus = [
				'hp'		 => $this->CharaData['hp']			 + $charaUpData['statusUpCnt'],
				'gooAtk'	 => $this->CharaData['gooAtk']		 + $charaUpData['gooUpCnt'],
				'choAtk'	 => $this->CharaData['choAtk']		 + $charaUpData['choUpCnt'],
				'paaAtk'	 => $this->CharaData['paaAtk']		 + $charaUpData['paaUpCnt'],
				'gooUpCnt'	 => $this->CharaData['gooUpCnt']	 + $charaUpData['gooUpCnt'],
				'choUpCnt'	 => $this->CharaData['choUpCnt']	 + $charaUpData['choUpCnt'],
				'paaUpCnt'	 => $this->CharaData['paaUpCnt']	 + $charaUpData['paaUpCnt']
			];
			$this->Model->exec('Chara', 'updateStatus', array($upDateStatus, $this->CharaData['uCharaId']));

			//リダイレクト引数受け渡し(賞金、キャラのステータス、アップした数値)
			//追加：フィーバータイム判定用のフラグ
			$param = [
				'prize'			=> $prize,
				'name'			=> $this->CharaData['name'],
				'deaultHp'		=> $this->CharaData['hp'],
				'deaultGooAtk'	=> $this->CharaData['gooAtk'],
				'deaultChoAtk'	=> $this->CharaData['choAtk'],
				'deaultPaaAtk'	=> $this->CharaData['paaAtk'],
				'statusUpCnt'	=> $charaUpData['statusUpCnt'],
				'gooAtkUpCnt'	=> $charaUpData['gooUpCnt'],
				'choAtkUpCnt'	=> $charaUpData['choUpCnt'],
				'paaAtkUpCnt'	=> $charaUpData['paaUpCnt'],
				'feverTimeFlug' => $flug
			];
		}
		// 自キャラのHPが0以下の場合(降参せずにプレイヤーが負けた場合)
		else if($this->CharaData['battleHp'] <= 0)
		{
			//リダイレクト引数受け渡し(賞金は0)
			$param = [
				'name'	=> $this->CharaData['name'],
				'prize' => 0,
				'skill' => $this->CharaData['skillFlag'],
				'imgId' => $this->CharaData['imgId'],
			];

			$this->Model->exec('Chara', 'charaDelFlag', $this->CharaData['uCharaId']);
			// 所持キャラ数の減算を行う
			$this->Lib->exec('ManageCharaPossession','subPossessionChara',array($this->user));
		}
		// どちらのHPも0以上の場合(降参として処理が呼ばれた場合)
		else
		{
			// 降参費用額計算
			$prize = $this->Lib->exec('Battle', 'surrenderCostCalc', array($this->CharaData, $this->Commission, $this->DifficultyData, $this->EnemyData));


			if($this->CharaData['skillFlag'] == 1 && $this->CharaData['imgId'] == 1)
			{
				$prize = 0;
			}
			// ユーザーの所持金 'money' から降参費用を減算しデータベースに格納
			$this->Lib->exec('Money', 'Subtraction', array($this->user,	$prize));

			// 降参費用をマイナスに
			$prize *= -1;

			//リダイレクト引数受け渡し(賞金は引退費用として)
			$param = [
				'name'	=> $this->CharaData['name'],
				'prize' => $prize,
				'skill' => $this->CharaData['skillFlag'],
				'imgId' => $this->CharaData['imgId'],
			];
		}

		// delFlagを立てる更新
		$this->standDelFlag();

		return $this->Lib->redirect('Battle','battleResult', $param);
	}

	/*
	 * delFlagを立てるファンクション
	 */
	public function standDelFlag()
	{
		// ユーザーIDを元にuBattleInfo(DB)からバトルデータを読み込み
		// BattleData にバトルデータを格納
		$this->BattleData = $this->Model->exec('BattleInfo', 'getBattleData', $this->user['id']);

		$this->Model->exec('BattleInfo', 'UpdateInfoBattleFlagData', $this->BattleData['id']);
	}
}
