<div>
	<center>コーチに配属しますか？</center>
</div>
<div>
	<div>
		<image src="{{CHAR_IMG_URL}}{{$coach['imgId']}}.png" alt="コーチイメージ"<
			name="imgId" value="{{$coach['id']}}" width="75" height="100">{{$coach['name']}}<br>
	</div>
	<div>
	↓
	</div>
	<div>
		<image src="{{CHAR_IMG_URL}}{{$viewData['selectCharaState']['imgId']}}.png" alt="キャライメージ"<
			name="imgId" value="{{$viewData['selectCharaState']['id']}}" width="75" height="100">{{$viewData['selectCharaState']['name']}}<br>
	</div>
	<form action="changeCoach" method="get">
		<input type="hidden" name="coachId" value="{{$coach['id']}}">
		<input type="hidden" name="id" value="{{$viewData['selectCharaState']['id']}}">
		<input type="hidden" name="imgId" value="{{$viewData['selectCharaState']['imgId']}}">
		<input type="hidden" name="name" value="{{$viewData['selectCharaState']['name']}}">
		<input type="hidden" name="rare" value="{{$viewData['selectCharaState']['rare']}}">
		<input type="hidden" name="attribute" value="{{$viewData['selectCharaState']['attribute']}}">
		<input type="hidden" name="hp" value="{{$viewData['selectCharaState']['hp']}}">
		<input type="hidden" name="gooAtk" value="{{$viewData['selectCharaState']['gooAtk']}}">
		<input type="hidden" name="choAtk" value="{{$viewData['selectCharaState']['choAtk']}}">
		<input type="hidden" name="paaAtk" value="{{$viewData['selectCharaState']['paaAtk']}}">
		<button type="submit">する</button>
	</form>
</div>