<div>
	<center>
	コーチ枠がいっぱいです<br>
	交代するコーチを選んでください<br>
	<br>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>
<form action="{{APP_URL}}SelectCoach/setCoach" method="get">
	<div>
		@foreach($viewData['coachList'] as $coach)
			<input type="image" src="{{CHAR_IMG_URL}}{{$coach['imgId']}}.png" alt="コーチイメージ"<
			name="uCoachId" value="{{$coach['id']}}" width="75" height="100">{{$coach['name']}}<br>
			<input type="hidden" name="charaId" value="{{$_GET['id']}}">
		@endforeach
	</div>
</form>

<form action ="selectCoach/deleteChara" method="get">
	<input type="hidden" name="id" value="{{$_GET['id']}}">
	<button type="submit" >コーチにしない</button>
</form>
<button type="button" onclick="location.href='{{APP_URL}}selectChara'">戻る</button>