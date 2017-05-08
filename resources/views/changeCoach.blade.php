<div>
	<center>コーチに配属しますか？</center>
</div>
<div>
	<div>
		<image src="{{IMG_URL}}{{$viewData['coach']['imgId']}}.png" alt="コーチイメージ"<
			name="imgId" value="{{$viewData['coach']['id']}}" width="100" height="100">{{$viewData['coach']['name']}}<br>
	</div>
	<div>
	↓
	</div>
	<div>
		<image src="{{IMG_URL}}{{$viewData['chara']['imgId']}}.png" alt="キャライメージ"<
			name="imgId" value="{{$viewData['chara']['id']}}" width="100" height="100">{{$viewData['chara']['name']}}<br>
	</div>
	<form action="changeCoach/changeCoach" method="get">
		<input type="hidden" name="coachId" value="{{$viewData['coach']['id']}}">
		<input type="hidden" name="charaId" value="{{$viewData['chara']['id']}}">
		<input type="hidden" name="charaimgId" value="{{$viewData['chara']['imgId']}}">
		<input type="hidden" name="charaname" value="{{$viewData['chara']['name']}}">
		<input type="hidden" name="chararare" value="{{$viewData['chara']['rare']}}">
		<input type="hidden" name="charahp" value="{{$viewData['chara']['hp']}}">
		<input type="hidden" name="charagooAtk" value="{{$viewData['chara']['gooAtk']}}">
		<input type="hidden" name="charachoAtk" value="{{$viewData['chara']['choAtk']}}">
		<input type="hidden" name="charapaaAtk" value="{{$viewData['chara']['paaAtk']}}">
		<button type="submit">する</button>
	</form>
	<button type="button" onclick="location.href='{{APP_URL}}selectChara'" >しない</button>
</div>
