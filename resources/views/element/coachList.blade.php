<div>
	<h3>コーチを選んでください。</h3>
</div>

{{--uCoach(DB)から持ってきたデータの表示--}}
@foreach($viewData['coachList'] as $val)
	<input type ="submit" class = "modal_btn test"><br>
	{{'グー成長確率　：'}}
	{{$val['gooUpProbability']}}<br>
	{{'チョキ成長確率：'}}
	{{$val['choUpProbability']}}<br>
	{{'パー成長確率　：'}}
	{{$val['paaUpProbability']}}<br>
@endforeach

{{-- popupウインドウ --}}
@include('popup/wrap', ['template' => 'test'])