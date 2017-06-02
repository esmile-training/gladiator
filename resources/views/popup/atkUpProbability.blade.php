<div>
	<?php $cnt = 0; ?>
	@foreach($viewData['coachList'] as $val)
		{{$val['gooUpProbability'][$cnt]}}
		{{$val['choUpProbability'][$cnt]}}
		{{$val['paaUpProbability'][$cnt]}}<br>
		<?php $cnt++; ?>
	@endforeach
</div>