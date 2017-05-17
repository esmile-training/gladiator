<div>
	<h3>コーチを選んでください。</h3>
</div>

{{--uCoach(DB)から持ってきたデータの表示--}}
@foreach($viewData['coachList'] as $val)
	<input type ="submit" class = "modal_btn test"><br>
	{{-- popupウインドウ --}}
	<div class="modal_btn test">
		@include('popup/'.'test' , ['uCharaId' => $val['id']])
		<div class="modal_frame">
			<div class="close">
				<span>close</span>
			</div>
		</div>
	</div>
	{{'グー成長確率　：'}}
	{{$val['gooUpProbability']}}<br>
	{{'チョキ成長確率：'}}
	{{$val['choUpProbability']}}<br>
	{{'パー成長確率　：'}}
	{{$val['paaUpProbability']}}<br>
@endforeach
