{{-- サイズ等指定 --}}
@include('common/battle')

<div class="battle_background{{$viewData['EnemyData']['difficulty']}}">
	
	<div class="hedder">
		<img src="{{IMG_URL_BATTLE}}difficulty{{$viewData['EnemyData']['difficulty']}}.png" class="difficulty_Name">

		{{--バトル終了のフラグが立っていなければ--}}
		@if ($viewData['BattleData']['delFlag'] != 1)
			<form method="get" action="{{APP_URL}}battle/makeResultData" onsubmit="doSomething();return false;">
				<input type="image" src="{{IMG_URL_BATTLE}}surrender.png" value="1" name="sub2" class="surrender_Button">
			</form>
			<img src="{{IMG_URL_BATTLE}}help.png"  class="help_Button">
			{{-- ヘルプのポップアップを表示するボタンにする --}}
	<!--		<form method="get" action="{{APP_URL}}battle/makeResultData" onsubmit="doSomething();return false;">
				<input type="image" src="{{IMG_URL_BATTLE}}help.png" value="1" name="sub2">
			</form>-->
		@endif
	</div>

	{{-- 敵HPの表示 --}}
	<div class="enemy_Status">
		{{ $viewData['EnemyData']['name'] }} のHP {{ $viewData['EnemyData']['battleHp'] }} / {{ $viewData['EnemyData']['hp'] }} <br />
		{{ $viewData['Type'][1] }} : {{ $viewData['EnemyData']['gooAtk']}}
		{{ $viewData['Type'][2] }} : {{ $viewData['EnemyData']['choAtk']}}
		{{ $viewData['Type'][3] }} : {{ $viewData['EnemyData']['paaAtk']}}
	</div>

	{{-- 攻撃の結果が入っていたら --}}
	@if ($viewData['CharaData']['result'] != 0)

		{{-- 勝敗の表示 --}}
	<div class="damage_Log">
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

	@endif

	{{-- バトル終了のフラグが立っていなければ次の攻撃の受け付け --}}
	@if ($viewData['BattleData']['delFlag'] != 1)
		{{-- それぞれのボタン表示 --}}
		<div class="button">
			<img src="{{IMG_URL_BATTLE}}buttonBg.png" class="button_bg" >
			<a href="{{APP_URL}}battle/updateBattleData?hand=1" class="button_goo_linkregion" >
				<img src={{IMG_URL_BATTLE}}goo.png class="button_icon" >
			</a>
			<a href="{{APP_URL}}battle/updateBattleData?hand=2" class="button_cho_linkregion" >
				<img src={{IMG_URL_BATTLE}}cho.png class="button_icon" >
			</a>
			<a href="{{APP_URL}}battle/updateBattleData?hand=3" class="button_paa_linkregion" >
				<img src={{IMG_URL_BATTLE}}paa.png class="button_icon" >
			</a>
		</div>
	@endif
	{{-- 自キャラステータスの表示 --}}
	<div class="player_Status">
		{{ $viewData['CharaData']['name'] }} のHP {{ $viewData['CharaData']['battleHp'] }} / {{ $viewData['CharaData']['hp'] }} <br />
		{{ $viewData['Type'][1] }} : {{ $viewData['CharaData']['gooAtk']}}
		{{ $viewData['Type'][2] }} : {{ $viewData['CharaData']['choAtk']}}
		{{ $viewData['Type'][3] }} : {{ $viewData['CharaData']['paaAtk']}}
	</div>
	
	<div class="player_Bar"> 
		<img src="{{IMG_URL_BATTLE}}charaBar.png">
	</div>
</div>
</body>