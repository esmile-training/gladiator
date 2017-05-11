<div>
	<h3>コーチを選んでください。</h3>  
	
	{{--uCoach(DB)から持ってきたデータの表示--}}
	<form action="{{APP_URL}}training/infoSet" method="get">
		@foreach($viewData['coachList'] as $key => $val)
			<input type ="submit" name="uCoachId" value="{{$val['id']}}"><br>
			{{'グー成長確率　：'}}
			{{$val['gooUpProbability']}}<br>
			{{'チョキ成長確率：'}}
			{{$val['choUpProbability']}}<br>
			{{'パー成長確率　：'}}
			{{$val['paaUpProbability']}}<br>
		@endforeach
		<input type ="hidden" name="uCharaId" value="{{$viewData['uCharaId']}}">
		<input type ="hidden" name="uCoachHp" value="{{$val['hp']}}">
		<select name="trainingTime">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
		</select>
	</form>
</div>
