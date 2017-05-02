<div>
	<center>
	コーチ枠がいっぱいです<br>
	交代するコーチを選んでください<br>
	<br>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>

<form action="{{APP_URL}}selectCoach/setCoach" method="get">
	<div>
		@foreach($viewData['coachList'] as $coach)
			<input type="image" src="{{IMG_URL}}{{$coach['imgId']}}.png" alt="コーチイメージ"<
			name="uCoachId" value="{{$coach['id']}}" width="100" height="100">{{$coach['name']}}<br>
			{{--var_dump($coach)--}}
		@endforeach
	</div>
	<input type="hidden" name="charaId" value="{{$_GET['id']}}">
</form>

<form action ="selectCoach/deleteChara" method="get">
	<input type="hidden" name="id" value="{{$_GET['id']}}">
	<button type="submit" >コーチにしない</button>
</form>
<button type="button" onclick="location.href='{{APP_URL}}selectChara'">戻る</button>