<div>
	{{'訓練が完了しました!'}}<br>
	@foreach($viewData['endTrainingChara'] as $val)
	{{$val['name']}}<br>
	HP => {{$val['hp']}}<br>
	Goo => {{$val['gooAtk']}}<br>
	cho => {{$val['choAtk']}}<br>
	paa => {{$val['paaAtk']}}<br>
	@endforeach
</div>