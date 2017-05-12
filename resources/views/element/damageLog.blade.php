<div>

	@if ( $viewData['CharaData']['result'] == $viewData['Result']['win'] )
		@if ( $viewData['CharaData']['hand'] == $viewData['Type'][1] )
		<div>
			{{$viewData['EnemyData']['name']}}
			に
			{{$viewData['CharaData']['battleGooAtk']}}
			のダメージ <br />
		</div>
		@elseif ( $viewData['CharaData']['hand'] == $viewData['Type'][2] )
		<div>
			{{ $viewData['EnemyData']['name'] }}
			に
			{{ $viewData['CharaData']['battleChoAtk'] }}
			のダメージ <br />
		</div>
		@elseif ( $viewData['CharaData']['hand'] == $viewData['Type'][3] )
		<div>
			{{ $viewData['EnemyData']['name'] }}
			に
			{{ $viewData['CharaData']['battlePaaAtk'] }}
			のダメージ <br />
		</div>
		@endif
	@elseif ($viewData['CharaData']['result'] == $viewData['Result']['lose'])
		@if ($viewData['EnemyData']['hand'] == $viewData['Type'][1])
		<div>
			{{$viewData['CharaData']['name']}}
			に
			{{$viewData['EnemyData']['battleGooAtk']}}
			のダメージ <br />
		</div>
		@elseif ($viewData['EnemyData']['hand'] == $viewData['Type'][2])
		<div>
			{{ $viewData['CharaData']['name'] }}
			に
			{{ $viewData['EnemyData']['battleChoAtk'] }}
			のダメージ <br />
		</div>
		@elseif ($viewData['EnemyData']['hand'] == $viewData['Type'][3])
		<div>
			{{ $viewData['CharaData']['name'] }}
			に
			{{ $viewData['EnemyData']['battlePaaAtk'] }}
			のダメージ <br />
		</div>
		@endif
	@elseif ($viewData['CharaData']['result'] == $viewData['Result']['draw'])
	<div>
		お互いにダメージなし<br />
	</div>
	@endif

</div>