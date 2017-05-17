<div>
	<h3>コーチを選んでください。</h3>
</div>

{{--uCoach(DB)から持ってきたデータの表示--}}
<?php
	$cnt = 0;
?>

@foreach($viewData['coachList'] as $val)
	<input type ="submit" class = "modal_btn test{{$cnt}}"><br>
	{{'グー成長確率　：'}}
	{{$val['gooUpProbability']}}<br>
	{{'チョキ成長確率：'}}
	{{$val['choUpProbability']}}<br>
	{{'パー成長確率　：'}}
	{{$val['paaUpProbability']}}<br>
	<?php $cnt++; ?>
@endforeach

{{-- popupウインドウ --}}
<div class="modal_btn test0">
	@include('popup/'.'test' , ['uCharaId' => $viewData['coachList'][0]['id']])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>

<div class="modal_btn test1">
	@include('popup/'.'test' , ['uCharaId' => $viewData['coachList'][1]['id']])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>

<div class="modal_btn test2">
	@include('popup/'.'test' , ['uCharaId' => $viewData['coachList'][2]['id']])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>