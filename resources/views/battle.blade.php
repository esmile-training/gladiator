{{-- サイズ等指定 --}}
@include('common/battle')

<div>
    <img class="janken" src="{{IMG_URL_TEST}}janken.jpg">
</div>

{{--バトル終了のフラグが立っていなければ--}}
@if ($viewData['BattleData']['delFlag'] != 1)

	<form method="get" action="{{APP_URL}}battle/makeResultData" onsubmit="doSomething();return false;">
		<input type="image" src="{{IMG_URL_TEST}}surrender.png" value="1" name="sub2">
	</form>

@endif

{{--攻撃の結果が入っていたら--}}
@if ($viewData['CharaData']['result'] != 0)

	{{--勝敗の表示--}}
<div>
    {{ $viewData['CharaData']['name'] }}
    は    
    {{ $viewData['Type'][$viewData['CharaData']['hand']] }}
    を出した！<br />
    {{ $viewData['EnemyData']['name'] }}
    は    
    {{ $viewData['Type'][$viewData['EnemyData']['hand']] }}
    を出した！<br />
    
    結果は{{ $viewData['Result'][$viewData['CharaData']['result']] }}！<br />
</div>

	{{--ダメージログの表示--}}
<div>
	@if ( $viewData['CharaData']['result'] == 1)
		<div>
			{{$viewData['EnemyData']['name']}} に
		@if ( $viewData['CharaData']['hand'] == 1)
			{{$viewData['CharaData']['battleGooAtk']}} のダメージ <br />
		@elseif ( $viewData['CharaData']['hand'] == 2)
			{{ $viewData['CharaData']['battleChoAtk'] }} のダメージ <br />
		@elseif ( $viewData['CharaData']['hand'] == 3)
			{{ $viewData['CharaData']['battlePaaAtk'] }} のダメージ <br />
		</div>
		@endif
	@elseif ($viewData['CharaData']['result'] == 2)
		<div>
			{{$viewData['CharaData']['name']}} に
		@if ($viewData['EnemyData']['hand'] == 1)
			{{$viewData['EnemyData']['battleGooAtk']}} のダメージ <br />
		@elseif ($viewData['EnemyData']['hand'] == 2)
			{{ $viewData['EnemyData']['battleChoAtk'] }} のダメージ <br />
		@elseif ($viewData['EnemyData']['hand'] == 3)
			{{ $viewData['EnemyData']['battlePaaAtk'] }} のダメージ <br />
		</div>
		@endif
	@elseif ($viewData['CharaData']['result'] == 3)
	<div>
		お互いにダメージなし<br />
	</div>
	@endif
</div>

@endif

{{--HPの表示--}}
<div>
	{{ $viewData['CharaData']['name'] }} のHP {{ $viewData['CharaData']['battleHp'] }} / {{ $viewData['CharaData']['hp'] }}
</div>

<div>
	{{ $viewData['EnemyData']['name'] }} のHP {{ $viewData['EnemyData']['battleHp'] }} / {{ $viewData['EnemyData']['hp'] }}    
</div>

{{--バトル終了のフラグが立っていたら--}}
@if ($viewData['BattleData']['delFlag'] == 1)
		
	<div>
		<a href="{{APP_URL}}battle/makeResultData">
			バトルリザルト画面へ
		</a>
	</div>

{{--立っていなければ次の攻撃の受け付け--}}
@else
	{{--それぞれのボタン表示--}}
	<form method="get" action="{{APP_URL}}battle/updateBattleData" onsubmit="doSomething();return false;">
		<input type="image" src="{{IMG_URL_TEST}}goo.jpg" value="1" name="sub1">　
		<input type="image" src="{{IMG_URL_TEST}}choki.png" value= "2" name="sub1">　
		<input type="image" src="{{IMG_URL_TEST}}paa.jpg" value= "3" name="sub1">　
	</form>

@endif