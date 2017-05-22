<div class="all">
	<div>
		<h3>コーチを選んでください。</h3>
	</div>
	<?php
		$cnt = 0;
	?>
	{{--uCoach(DB)から持ってきたデータの表示--}}
	<div class="modal_container">
		@foreach($viewData['coachList'] as $val)
		<input type ="submit" class = "modal_btn trainingPopup{{$cnt}}" value="{{$val['id']}}"><br>
			{{'グー成長確率　：'}}
			{{$val['gooUpProbability']}}<br>
			{{'チョキ成長確率：'}}
			{{$val['choUpProbability']}}<br>
			{{'パー成長確率　：'}}
			{{$val['paaUpProbability']}}<br>
			<?php $cnt++; ?>
		@endforeach
	</div>
</div>

{{-- popupウインドウ --}}
<div class="modal trainingPopup0">
	@include('popup/'.'training' , ['uCoachId' => 0])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>

<div class="modal trainingPopup1">
	@include('popup/'.'training' , ['uCoachId' => 1])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>

<div class="modal trainingPopup2">
	@include('popup/'.'training' , ['uCoachId' => 2])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>