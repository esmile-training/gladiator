<div>

	@if ( $viewData['PcData']['result'] == $viewData['Result']['win'] )
	@if ( $viewData['PcData']['hand'] == $viewData['Type']['goo'] )
	<div>
		{{$viewData['EnmData']['name']}}
		に
		{{$viewData['PcData']['bGooAtk']}}
		のダメージ <br />
	</div>
	@elseif ( $viewData['PcData']['hand'] == $viewData['Type']['cho'] )
	<div>
		{{ $viewData['EnmData']['name'] }}
		に
		{{ $viewData['PcData']['bChoAtk'] }}
		のダメージ <br />
	</div>
	@elseif ( $viewData['PcData']['hand'] == $viewData['Type']['paa'] )
	<div>
		{{ $viewData['EnmData']['name'] }}
		に
		{{ $viewData['PcData']['bPaaAtk'] }}
		のダメージ <br />
	</div>
	@endif
	@elseif ( $viewData['PcData']['result'] == $viewData['Result']['lose'] )
	@if ( $viewData['EnmData']['hand'] == $viewData['Type']['goo'] )
	<div>
		{{$viewData['PcData']['name']}}
		に
		{{$viewData['EnmData']['bGooAtk']}}
		のダメージ <br />
	</div>
	@elseif ( $viewData['EnmData']['hand'] == $viewData['Type']['cho'] )
	<div>
		{{ $viewData['PcData']['name'] }}
		に
		{{ $viewData['EnmData']['bChoAtk'] }}
		のダメージ <br />
	</div>
	@elseif ( $viewData['EnmData']['hand'] == $viewData['Type']['paa'] )
	<div>
		{{ $viewData['PcData']['name'] }}
		に
		{{ $viewData['EnmData']['bPaaAtk'] }}
		のダメージ <br />
	</div>
	@endif
	@elseif ( $viewData['PcData']['result'] == $viewData['Result']['draw'] )
	<div>
		お互いにダメージなし<br />
	</div>
	@endif

</div>