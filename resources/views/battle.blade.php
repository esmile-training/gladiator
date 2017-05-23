{{-- サイズ等指定 --}}
@include('common/battle')

	<img src="{{IMG_URL}}battle/battle_Bg{{$viewData['EnemyData']['difficulty']}}.png" class="battle_background">
	
	<table border="0" class="battle_hedder">
		<tr>
			<td width="20%">
				<img src="{{IMG_URL}}battle/difficulty{{$viewData['EnemyData']['difficulty']}}.png" >
			</td>
			<td width="20%"></td>
			<td width="20%"></td>
			{{-- 押されたらポップアップを表示する --}}
			<td width="20%">
				<a href="{{APP_URL}}battle/makeResultData" >
					<img src="{{IMG_URL}}battle/surrender.png" >
				</a>
			</td>
			<td width="20%">
				<a>
					<img src="{{IMG_URL}}battle/help.png" >
				</a>
			</td>
		</tr>
	</table>

	<div class="battle_enemy_status">
		<img src="{{IMG_URL}}battle/enemy_Bar.png" class="battle_enemy_status_bar" >	
		<img src="{{IMG_URL}}chara/icon/icon_{{$viewData['EnemyData']['imgId']}}.png" class="battle_enemy_status_icon" >
		<div class="battle_enemy_status_hp">
			{{ $viewData['EnemyData']['name'] }} のHP {{ $viewData['EnemyData']['battleHp'] }} / {{ $viewData['EnemyData']['hp'] }}
		</div>
		<div class="battle_enemy_status_atk">
			{{ $viewData['Type'][1] }} : {{ $viewData['EnemyData']['gooAtk']}}
			{{ $viewData['Type'][2] }} : {{ $viewData['EnemyData']['choAtk']}}
			{{ $viewData['Type'][3] }} : {{ $viewData['EnemyData']['paaAtk']}}			
		</div>
	</div>

	{{-- 攻撃の結果が入っていたら --}}
	@if ($viewData['CharaData']['result'] != 0)
		<div class="battle_enemy_hand">
			<img src="{{IMG_URL}}battle/enemy_Hand_Bg.png" class="battle_enemy_hand_bg" >
			<img src={{IMG_URL}}battle/hand{{$viewData['EnemyData']['hand']}}.png class="battle_enemy_hand_icon" >
		</div>

			{{-- 勝敗の表示 --}}
		<div class="damage_log">
			<img src="{{IMG_URL}}battle/damagelog_Bg.png" class="damage_log_Bg" >
			<div class="damage_log_message">
				{{ $viewData['CharaData']['name'] }}
				は    
				{{ $viewData['Type'][$viewData['CharaData']['hand']] }}
				を出した！<br />
				{{ $viewData['EnemyData']['name'] }}
				は    
				{{ $viewData['Type'][$viewData['EnemyData']['hand']] }}
				を出した！<br />

				結果は{{ $viewData['Result'][$viewData['CharaData']['result']] }}！<br />

				{{-- ダメージログの表示 --}}
				@if ( $viewData['CharaData']['result'] == 1)
						{{$viewData['EnemyData']['name']}} に
					@if ( $viewData['CharaData']['hand'] == 1)
						{{$viewData['CharaData']['battleGooAtk']}} のダメージ <br />
					@elseif ( $viewData['CharaData']['hand'] == 2)
						{{ $viewData['CharaData']['battleChoAtk'] }} のダメージ <br />
					@elseif ( $viewData['CharaData']['hand'] == 3)
						{{ $viewData['CharaData']['battlePaaAtk'] }} のダメージ <br />
					@endif
				@elseif ($viewData['CharaData']['result'] == 2)
						{{$viewData['CharaData']['name']}} に
					@if ($viewData['EnemyData']['hand'] == 1)
						{{$viewData['EnemyData']['battleGooAtk']}} のダメージ <br />
					@elseif ($viewData['EnemyData']['hand'] == 2)
						{{ $viewData['EnemyData']['battleChoAtk'] }} のダメージ <br />
					@elseif ($viewData['EnemyData']['hand'] == 3)
						{{ $viewData['EnemyData']['battlePaaAtk'] }} のダメージ <br />
					@endif
				@elseif ($viewData['CharaData']['result'] == 3)
					お互いにダメージなし<br />
				@endif
					{{-- バトル終了のフラグが立っていたら --}}
				@if ($viewData['BattleData']['delFlag'] == 1)
						<a href="{{APP_URL}}battle/makeResultData">
							バトルリザルト画面へ
						</a>
				@endif
			</div>
		</div>
	@else
		{{-- 何も出してない敵の手の枠 --}}
		<div class="battle_enemy_hand">
			<img src="{{IMG_URL}}battle/enemy_Hand_Bg.png" class="battle_enemy_hand_bg" >
		</div>
		{{-- メッセージログの枠 --}}
		<div class="damage_log">
			<img src="{{IMG_URL}}battle/damagelog_Bg.png" class="damage_log_Bg" >
		</div>
	

	@endif

	{{-- バトル終了のフラグが立っていなければ次の攻撃の受け付け --}}
	@if ($viewData['BattleData']['delFlag'] != 1)
		{{-- それぞれのボタン表示 --}}
		<div class="battle_playerhand_button">
			<img src="{{IMG_URL}}battle/button_Bg.png" class="battle_playerhand_button_bg" >
			<a href="{{APP_URL}}battle/updateBattleData?hand=1" class="battle_playerhand_button_goo_linkregion" >
				<img src={{IMG_URL}}battle/hand1.png class="battle_playerhand_button_icon" >
			</a>
			<a href="{{APP_URL}}battle/updateBattleData?hand=2" class="battle_playerhand_button_cho_linkregion" >
				<img src={{IMG_URL}}battle/hand2.png class="battle_playerhand_button_icon" >
			</a>
			<a href="{{APP_URL}}battle/updateBattleData?hand=3" class="battle_playerhand_button_paa_linkregion" >
				<img src={{IMG_URL}}battle/hand3.png class="battle_playerhand_button_icon" >
			</a>
		</div>
	@endif
	{{-- 自キャラステータスの表示 --}}
	<div class="battle_player_status">
		<div class="battle_player_status_hp">
			{{ $viewData['CharaData']['name'] }} のHP {{ $viewData['CharaData']['battleHp'] }} / {{ $viewData['CharaData']['hp'] }}
		</div>
		<div class="battle_player_status_atk">
			{{ $viewData['Type'][1] }} : {{ $viewData['CharaData']['gooAtk']}}
			{{ $viewData['Type'][2] }} : {{ $viewData['CharaData']['choAtk']}}
			{{ $viewData['Type'][3] }} : {{ $viewData['CharaData']['paaAtk']}}			
		</div>
		<img src="{{IMG_URL}}battle/player_Bar.png" class="battle_player_status_bar">
		<img src="{{IMG_URL}}chara/icon/icon_{{$viewData['CharaData']['imgId']}}.png" class="battle_player_status_icon" >
	</div>
</body>