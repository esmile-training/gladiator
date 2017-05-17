{{-- js --}}
@include('common/js', ['file' => 'training'])
<form action="{{APP_URL}}training/infoSet" method="get" >
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

	<input type ="submit" name="uCoachId" value="{{$uCharaId}}">
	<input type ="hidden" name="uCharaId" value="{{$viewData['uCharaId']}}">
	<input type ="hidden" name="uCoachHp" value="{{$val['hp']}}">
</form>