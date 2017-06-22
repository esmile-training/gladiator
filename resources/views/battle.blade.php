<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gladiator</title>
	<link href="{{APP_URL}}css/reset.css?var={{time()}}" rel="stylesheet" type="text/css">
	<link href="{{APP_URL}}css/style.css?var={{time()}}" rel="stylesheet" type="text/css">
	<link href="{{APP_URL}}css/modal.css?var={{time()}}" rel="stylesheet" type="text/css">
	<link href="{{APP_URL}}css/battle.css?var={{time()}}" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrapper">
		{{-- 降参用のデータ統合 --}}
		<?php
			$surrenderData['cost']	= $viewData['surrenderCost'];
			$surrenderData['money']	= $viewData['userData']['money'];
		?>
		{{-- アイテム用のデータ統合 --}}
		<?php 
			$itemPopupData['belongingsData'] = $viewData['belongingsData'];
			$itemPopupData['charaData'] = $viewData['charaData'];
		?>
		{{-- ポップアップの宣言 --}}
		@include('popup/wrap', [
			'class'		=> 'surrenderButton', 
			'template'	=> 'surrender',
			'data'		=>	['surrenderData' => $surrenderData]
		])
		@include('popup/wrap', [
			'class'		=> 'helpButton',
			'template'	=> 'help',
			'data'		=> ['log' => $viewData['enemyData']['difficulty']]
		])
		@include('popup/wrap', [
			'class'		=> 'skill_action_button',
			'template'	=> 'battleSkill',
			'data'		=> ['charaData' => $viewData['charaData']]
		])
		@include('popup/wrap', [
			'class'		=> 'item_button',
			'template'	=> 'battleItem',
			'data'		=> ['belongingsData' => $itemPopupData]
		])
		
		{{-- 背景画像 --}}
		<img src="{{IMG_URL}}battle/battle_Bg{{$viewData['enemyData']['difficulty']}}.jpg" class="battle_bg">

		{{-- バトル終了フラグが立っていなければヘッダー部分表示 --}}
		@if ($viewData['battleData']['delFlag'] != 1)
		<table border="0" class="battle_hedder">
			<tr>
				<td width="20%">
					{{-- 難易度 --}}
					<img src="{{IMG_URL}}battle/diff{{$viewData['enemyData']['difficulty']}}.png">
				</td>
				<td width="20%">
					{{-- アイテムボタン --}}
					@if($viewData['charaData']['result'] == 5)
						<img class="item_button" src="{{IMG_URL}}battle/itemButtonDown.png">
					@else
						<a>
							<img class="modal_btn item_button image_change" src="{{IMG_URL}}battle/itemButton.png">
						</a>
					@endif
				</td>
				<td width="20%"></td>
				<td width="20%">
					{{-- 降参ボタン --}}
					<a>
						<img class="modal_btn surrenderButton image_change" src="{{IMG_URL}}battle/surrender.png">
					</a>
				</td>
				<td width="20%">
					{{-- 説明ボタン --}}
					<a>
						<img class="modal_btn helpButton image_change" src="{{IMG_URL}}battle/help.png">
					</a>
				</td>
			</tr>
		</table>
		@endif

		{{-- 敵キャラステータスの表示領域 --}}
		<div class="battle_enemy_status">
			{{-- 敵キャラのステータス枠 --}}
			<img src="{{IMG_URL}}battle/enemy_Status_Bar.png" class="battle_enemy_status_bar">
			{{-- 敵キャラのアイコン --}}
			<img src="{{IMG_URL}}chara/icon/icon_{{$viewData['enemyData']['imgId']}}.png" class="battle_enemy_status_icon" >
			{{-- 敵キャラのHP部分の領域 --}}
			<div class="battle_enemy_status_hp_bar_ragion">
				{{-- 敵キャラのHPバー枠 --}}
				<img src="{{IMG_URL}}battle/hp_Bar_Flame.png" class="battle_enemy_status_hp_bar_flame">
				{{-- 敵キャラのHPバー部分の領域 --}}
				<div style="position: absolute; left: 0%; top: 1%; width: {{$viewData['enemyData']['battleHp'] / ( $viewData['enemyData']['hp'] / 100)}}%; height: 70%;">
					{{-- 敵キャラのHPバー --}}
					<img src="{{IMG_URL}}battle/enemy_Hp_Bar.png" class="battle_enemy_status_hp_bar">
				</div>
			</div>
			{{-- 敵キャラのHPログ --}}
			<div class="battle_enemy_status_hp">
				<table border="0">
					<tr valign="middle">
						<td width="65%" align="left">
							{{ $viewData['enemyData']['name'] }}
						</td>
						<td width="5%">
							<img src={{IMG_URL}}chara/status/hp.png class="battle_enemy_status_hp_img">
						</td>
						<td width="25%" align="left">
							{{ $viewData['enemyData']['battleHp'] }} / {{ $viewData['enemyData']['hp'] }}
						</td>
						<td width="5%"></td>
					</tr>
				</table>
			</div>
			{{-- 敵キャラの攻撃力ログ --}}
			<div class="battle_enemy_status_atk">
				<table border="0">
					<tr valign="middle">
						<td width="15%"></td>
						<td width="5%">
							<img src={{IMG_URL}}chara/status/hand1.png class="battle_enemy_status_atk_goo_img">
						</td>
						<td width="20%" align="left">
							{{ $viewData['enemyData']['gooAtk']}}
						</td>
						<td width="5%">
							<img src={{IMG_URL}}chara/status/hand2.png class="battle_enemy_status_atk_cho_img">
						</td>	
						<td width="20%" align="left">
							{{ $viewData['enemyData']['choAtk']}}
						</td>
						<td width="5%">
							<img src={{IMG_URL}}chara/status/hand3.png class="battle_enemy_status_atk_paa_img">
						</td>
						<td width="20%" align="left">
							{{ $viewData['enemyData']['paaAtk']}}
						</td>
						<td width="10%"></td>
					</tr>
				</table>
			</div>
		</div>

		{{-- 攻撃の結果が入っていたら --}}
		@if ($viewData['charaData']['result'] != 0)
			{{-- 敵の出した手 --}}
			<div class="battle_enemy_hand">
				<img src="{{IMG_URL}}battle/enemy_Hand_Bg.png" class="battle_enemy_hand_bg" >
				<img id="enemyHand" src="{{IMG_URL}}chara/status/hand{{$viewData['enemyData']['hand']}}.png" class="battle_enemy_hand_img" >
			</div>

			{{-- 勝敗の表示 --}}
			<div class="battle_log">
				<img src="{{IMG_URL}}battle/damagelog_Bg.png" class="damage_log_Bg" >
				<div id="battleLog" class="battle_log_message">
				@if($viewData['charaData']['result'] == 4)
					{{ $viewData['charaData']['name'] }}
					は	
					{{ $viewData['type'][$viewData['charaData']['hand']] }}
					を発動した！<br>

					@if($viewData['charaData']['imgId'] == 10 && $viewData['charaData']['skillFlag'] == 1 && $viewData['enemyData']['battleHp'] <= 0)
						一撃必殺　死の鎌！
					@endif

					@if($viewData['charaData']['imgId'] == 10 && $viewData['charaData']['skillFlag'] == 1 && $viewData['enemyData']['battleHp'] >= 1)
						しかし何もおきなかった....
					@endif

					@if($viewData['charaData']['imgId'] == 1 && $viewData['charaData']['skillFlag'] == 1)
						しかし何もおきなかった....
					@endif
				@elseif($viewData['charaData']['result'] == 5)
					アイテムを使った
				@else
					{{ $viewData['charaData']['name'] }}
					は	
					{{ $viewData['type'][$viewData['charaData']['hand']] }}
					を出した！<br />
					{{ $viewData['enemyData']['name'] }}
					は	
					{{ $viewData['type'][$viewData['enemyData']['hand']] }}
					を出した！<br />
					<br />
					@if($viewData['charaData']['result'] == 1)
						<span class="battle_log_message_win">
							結果は {{ $viewData['result'][$viewData['charaData']['result']] }}！<br />
						</span>
					@elseif($viewData['charaData']['result'] == 2)
						<span class="battle_log_message_lose">
							結果は {{ $viewData['result'][$viewData['charaData']['result']] }}！<br />
						</span>
					@else
						<span class="battle_log_message_draw">
							結果は {{ $viewData['result'][$viewData['charaData']['result']] }}！<br />
						</span>
					@endif
					<br />
					{{-- ダメージログの表示 --}}
					@if ( $viewData['charaData']['result'] == 1)
							{{$viewData['enemyData']['name']}} に
						@if ( $viewData['charaData']['hand'] == 1)
							{{$viewData['charaData']['damage']}} のダメージ <br />
						@elseif ( $viewData['charaData']['hand'] == 2)
							{{ $viewData['charaData']['damage'] }} のダメージ <br />
						@elseif ( $viewData['charaData']['hand'] == 3)
							{{ $viewData['charaData']['damage'] }} のダメージ <br />
						@endif
					@elseif ($viewData['charaData']['result'] == 2)
							{{$viewData['charaData']['name']}} に
						@if ($viewData['enemyData']['hand'] == 1)
							{{$viewData['enemyData']['damage']}} のダメージ <br />
						@elseif ($viewData['enemyData']['hand'] == 2)
							{{ $viewData['enemyData']['damage'] }} のダメージ <br />
						@elseif ($viewData['enemyData']['hand'] == 3)
							{{ $viewData['enemyData']['damage'] }} のダメージ <br />
						@endif
					@elseif ($viewData['charaData']['result'] == 3)
						お互いにダメージなし<br />
					@endif
				@endif
				</div>
			</div>
		@else
			{{-- 何も出してない敵の手の枠 --}}
			<div class="battle_enemy_hand">
				<img src="{{IMG_URL}}battle/enemy_Hand_Bg.png" class="battle_enemy_hand_bg" >
				<img id="enemyHand" src="{{IMG_URL}}chara/status/hand0.png" class="battle_enemy_hand_img" >
			</div>

			{{-- メッセージログの枠 --}}
			<div class="battle_log">
				<img src="{{IMG_URL}}battle/damagelog_Bg.png" class="damage_log_Bg" >
			</div>
		@endif

		{{-- バトル終了のフラグが立っていなければ次の攻撃の受け付け --}}
		@if ($viewData['battleData']['delFlag'] != 1)
			{{-- それぞれのボタン表示 --}}
			<div class="battle_playerhand_button">
				<img src="{{IMG_URL}}battle/button_Bg.png" class="battle_playerhand_button_bg">
				<a href="{{APP_URL}}battle/updateBattleData?hand=1" class="battle_playerhand_button_goo_linkregion clickfalse visibil">
					<img id="playerHand1" src="{{IMG_URL}}chara/status/hand1.png" class="battle_playerhand_button_img battle_Button">
				</a>
				<a href="{{APP_URL}}battle/updateBattleData?hand=2" class="battle_playerhand_button_cho_linkregion clickfalse visibil">
					<img id="playerHand2" src="{{IMG_URL}}chara/status/hand2.png" class="battle_playerhand_button_img battle_Button">
				</a>
				<a href="{{APP_URL}}battle/updateBattleData?hand=3" class="battle_playerhand_button_paa_linkregion clickfalse visibil">
					<img id="playerHand3" src="{{IMG_URL}}chara/status/hand3.png" class="battle_playerhand_button_img battle_Button">
				</a>
			</div>
		{{-- バトル終了のフラグが立っていたら攻撃の受け付けをしない --}}
		@else
			{{-- リザルト画面へ行くボタン表示 --}}
			<div>
				<a href="{{APP_URL}}battle/makeResultData" class="battle_battleresult_button clickfalse" >
					<img class="battle_battleresult_button_img image_change" src="{{IMG_URL}}battle/toBattleResult.png" >
				</a>
			</div>
		@endif
		{{-- 自キャラステータスの表示領域 --}}
		<div class="battle_player_status">
			{{-- 自キャラのステータス枠 --}}
			<img src="{{IMG_URL}}battle/player_Status_Bar.png" class="battle_player_status_bar">
			{{-- スキルターン --}}
			<?php $count = (int)$viewData['charaData']['drawCount']; ?>
			{{-- 自キャラのアイコン --}}
			@if($viewData['charaData']['drawCount'] == 0)
			<a class="battle_playerhand_button_chara_linkregion">
				<img class="modal_btn skill_action_button battle_player_status_icon_on" src="{{IMG_URL}}chara/icon/icon_{{$viewData['charaData']['imgId']}}.png" >	
				<img class="modal_btn skill_action_button battle_player_icon_tap" src="{{IMG_URL}}battle/Tap.png" >	
			</a>
			{{-- スキルターン表示枠 --}}
				<img src="{{IMG_URL}}battle/gage0.png" class="battle_player_skill_frame">
			@else	
				{{-- スキルターン表示枠 --}}
				<img src="{{IMG_URL}}battle/gage{{$count}}.png" class="battle_player_skill_frame">
				<img src="{{IMG_URL}}chara/icon/icon_{{$viewData['charaData']['imgId']}}.png" class="battle_player_status_icon_off">
			@endif
			{{-- 自キャラのHP部分の領域 --}}
			<div class="battle_player_status_hp_bar_ragion">
				{{-- 自キャラのHPバー枠 --}}
				<img src="{{IMG_URL}}battle/hp_Bar_Flame.png" class="battle_player_status_hp_bar_flame">
				{{-- 自キャラのHPバー部分の領域 --}}
				<div style="position: absolute; right: 0%; bottom: 1%; width: {{$viewData['charaData']['battleHp'] / ( $viewData['charaData']['hp'] / 100)}}%; height: 70%;">
					{{-- 自キャラのHPバー --}}
					<img src="{{IMG_URL}}battle/player_Hp_Bar.png" class="battle_player_status_hp_bar">
				</div>
			</div>
			{{-- 自キャラのHPログ --}}
			<div class="battle_player_status_hp">
				<table border="0">
					<tr>
						<td width="5%"></td>
						<td width="65%" align="left">
							{{ $viewData['charaData']['name'] }}
						</td>
						<td width="5%">
							<img src="{{IMG_URL}}chara/status/hp.png" class="battle_player_status_hp_img">
						</td>	
						<td width="25%" align="left">
							{{ $viewData['charaData']['battleHp'] }} / {{ $viewData['charaData']['hp'] }}
						</td>
					</tr>
				</table>
			</div>
			{{-- 自キャラの攻撃力ログ --}}
			<div class="battle_player_status_atk">
				<table border="0">
					<tr valign="middle">
						<td width="15%"></td>
						<td width="5%">
							<img src="{{IMG_URL}}chara/status/hand1.png" class="battle_player_status_atk_goo_img">
						</td>
						<td width="20%" align="left">
							@if($viewData['charaData']['battleGooAtk'] > $viewData['charaData']['gooAtk'])
							<font class = "battle_gooAtkUpFont">
							{{ $viewData['charaData']['battleGooAtk']}}
							</font>
							<img src="{{IMG_URL}}battle/gooUpYajirushi.png" class="battle_gooAtkUpArrow">
							@else
							{{ $viewData['charaData']['gooAtk']}}
							@endif
						</td>
						<td width="5%">
							<img src="{{IMG_URL}}chara/status/hand2.png" class="battle_player_status_atk_cho_img">
						</td>	
						<td width="20%" align="left">
							@if($viewData['charaData']['battleChoAtk'] > $viewData['charaData']['choAtk'])
							<font class = "battle_choAtkUpFont">
							{{ $viewData['charaData']['battleChoAtk']}}
							</font>
							<tb>
								<img src="{{IMG_URL}}battle/choUpYajirushi.png" class="battle_choAtkUpArrow">
							</tb>
							@else	
							{{ $viewData['charaData']['choAtk']}}
							@endif
						</td>
						<td width="5%">
							<img src="{{IMG_URL}}chara/status/hand3.png" class="battle_player_status_atk_paa_img">
						</td>
						<td width="20%" align="left">
							@if($viewData['charaData']['battlePaaAtk'] > $viewData['charaData']['paaAtk'])
							<font class = "battle_paaAtkUpFont">
							{{ $viewData['charaData']['battlePaaAtk']}}
							</font>
							<tb>
								<img src="{{IMG_URL}}battle/paaUpYajirushi.png" class="battle_paaAtkUpArrow">
							</tb>
							@else
							{{ $viewData['charaData']['paaAtk']}}
							@endif
						</td>
						<td width="5%">
							@if($viewData['charaData']['imgId'] == 8 && $viewData['charaData']['skillFlag'] == 1)
							<img src="{{IMG_URL}}battle/heal.png" class = "skill_healIcon">
							<img src="{{IMG_URL}}battle/up.png" class = "skill_healUpIcon">
							@endif
							@if($viewData['charaData']['imgId'] == 6 && $viewData['charaData']['skillFlag'] == 1)
							<img src="{{IMG_URL}}battle/shield.png" class = "skill_shieldIcon">
							<img src="{{IMG_URL}}battle/up.png" class = "skill_shieldUpIcon">
							@endif
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<div>
	<script type="text/javascript">
		$(function(){
		$('img.battle_Button').click(function(){
			// srcの取得
			var getSrc = $(this).attr('src');

			// "/"ごとにURL分割
			var beforeImage = getSrc.split("/");
			// 画像名だけを抽出
			beforeImage = beforeImage[beforeImage.length - 1];

			// すでに画像名に処理後の画像名が入っていれば何もなし
			if(beforeImage.match('Up') || beforeImage.match('Down'))
			{
				return false;
			}

			// 抽出した画像名から名前と拡張子を分割
			var afterImage = beforeImage.split(".");

			// 画像名に押された後の画像名を連結
			afterImage = afterImage[0] + 'Up.' + afterImage[1];

			// もともとの画像と変更
			var changeL = getSrc.replace(beforeImage , afterImage);
			$(this).attr('src', changeL);

			// 敵の手画像をはてなの画像に変更
			var afterImageE = "{{IMG_URL}}chara/status/hand0.png";
			document.getElementById("enemyHand").src = afterImageE;

			// グー、チョキ、パーのDown画像定義
			var afterImageG = "{{IMG_URL}}chara/status/hand1Down.png";
			var afterImageC = "{{IMG_URL}}chara/status/hand2Down.png";
			var afterImageP = "{{IMG_URL}}chara/status/hand3Down.png";

			// idを取得して、そのid以外の攻撃ボタンを消す
			var idname = $(this).attr("id");

			// グーが押されたら
			if(idname === "playerHand1")
			{
				// チョキとパーの画像を変更            
				document.getElementById("playerHand2").src = afterImageC;
				document.getElementById("playerHand3").src = afterImageP;
			}
			// チョキが押されたら
			else if(idname === "playerHand2")
			{
				// グーとパーの画像を変更 
				document.getElementById("playerHand1").src = afterImageG;
				document.getElementById("playerHand3").src = afterImageP; 
			}
			// パーが押されたら
			else if(idname === "playerHand3")
			{
				// グーとチョキの画像を変更
				document.getElementById("playerHand1").src = afterImageG;
				document.getElementById("playerHand2").src = afterImageC; 
			}
		});

		// 表示を消す処理
		$('.visibil').click(function() {
			// ログの表示を消す
			document.getElementById("battleLog").style.visibility="hidden";
		});
	});
	</script>
</div>
	{{-- jsの宣言 --}}
	<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/modal.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/imgChange.js"></script>
	<script type="text/javascript" src="{{APP_URL}}js/skill.js"></script>
</body>