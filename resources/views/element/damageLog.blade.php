<div>

	@if ( $viewData['CharaData']['result'] == $viewData['Result']['win'] )
	@if ( $viewData['CharaData']['hand'] == $viewData['Type']['goo'] )
	<div>
		{{$viewData['EnemyData']['name']}}
		に
		{{$viewData['CharaData']['bGooAtk']}}
		のダメージ <br />
	</div>
	@elseif ( $viewData['CharaData']['hand'] == $viewData['Type']['cho'] )
	<div>
		{{ $viewData['EnemyData']['name'] }}
		に
		{{ $viewData['CharaData']['bChoAtk'] }}
		のダメージ <br />
	</div>
	@elseif ( $viewData['CharaData']['hand'] == $viewData['Type']['paa'] )
	<div>
		{{ $viewData['EnemyData']['name'] }}
		に
		{{ $viewData['CharaData']['bPaaAtk'] }}
		のダメージ <br />
	</div>
	@endif
	@elseif ($viewData['CharaData']['result'] == $viewData['Result']['lose'])
	@if ($viewData['EnemyData']['hand'] == $viewData['Type']['goo'])
	<div>
		{{$viewData['CharaData']['name']}}
		に
		{{$viewData['EnemyData']['bGooAtk']}}
		のダメージ <br />
	</div>
	@elseif ($viewData['EnemyData']['hand'] == $viewData['Type']['cho'])
	<div>
		{{ $viewData['CharaData']['name'] }}
		に
		{{ $viewData['EnemyData']['bChoAtk'] }}
		のダメージ <br />
	</div>
	@elseif ($viewData['EnemyData']['hand'] == $viewData['Type']['paa'])
	<div>
		{{ $viewData['CharaData']['name'] }}
		に
		{{ $viewData['EnemyData']['bPaaAtk'] }}
		のダメージ <br />
	</div>
	@endif
	@elseif ($viewData['CharaData']['result'] == $viewData['Result']['draw'])
	<div>
		お互いにダメージなし<br />
	</div>
	@endif

</div>