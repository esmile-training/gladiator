{{--CSS--}}
@include('common/css', ['file' => 'atkUpProbabilityPopup'])

<div class="atkUpProbability_all">
	<div class="title_text">
		{{"強化成功率"}}
	</div>
	<div class="img_list">
		<img class="goo_icon" src="{{IMG_URL}}/chara/status/hand1.png">
		<img class="cho_icon" src="{{IMG_URL}}/chara/status/hand2.png">
		<img class="paa_icon" src="{{IMG_URL}}/chara/status/hand3.png">
	</div>
	
	<div class="table_list">
	@for($i = 0; $i < 10; $i++)
		<table border="0">
			<tr>
				<td width="10%"></td>
				<td class="cntProbability_text" width="30%">
					@if($i < 10)
					{{$i}}{{"回成功時："}}
					@endif
				</td>
				<td class="upProbability_text" width="20%">
					{{ $viewData['gooUpProbability'][$cnt][$i]}}{{"%"}}
				</td>
				<td class="upProbability_text" width="20%">
					{{ $viewData['choUpProbability'][$cnt][$i]}}{{"%"}}
				</td>
				<td class="upProbability_text" width="20%">
					{{ $viewData['paaUpProbability'][$cnt][$i]}}{{"%"}}
				</td>
			<tr>
		</table>
	@endfor
	</div>
</div>