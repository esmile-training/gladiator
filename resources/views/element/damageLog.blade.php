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