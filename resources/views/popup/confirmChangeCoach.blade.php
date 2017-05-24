<div>
	<center>コーチに配属しますか？</center>
</div>
<div>
	<div>
		<image class="coach" src="{{IMG_URL_CHARA}}/icon/icon_{{$coach['imgId']}}.png" alt="コーチイメージ"<
			name="imgId" value="{{$coach['id']}}" width="75" height="100">
	</div>
	<div>
		{{$coach['name']}}<br>
	</div>
	<div>
	↓
	</div>
	<div>
		<image class="coach" src="{{IMG_URL_CHARA}}/icon/icon_{{$viewData['selectCharaState']['imgId']}}.png" alt="キャライメージ"<
			name="imgId" value="{{$viewData['selectCharaState']['id']}}" width="75" height="100">
	</div>
	<div>
			{{$viewData['selectCharaState']['name']}}<br>
	</div>
	<div>
	<a href="{{APP_URL}}SelectCoach/changeCoach?coachId={{$coach['id']}}&id={{$viewData['selectCharaState']['id']}}&imgId={{$viewData['selectCharaState']['imgId']}}&name={{$viewData['selectCharaState']['name']}}&rare={{$viewData['selectCharaState']['rare']}}&attribute={{$viewData['selectCharaState']['attribute']}}&hp={{$viewData['selectCharaState']['hp']}}&gooAtk={{$viewData['selectCharaState']['gooAtk']}}&choAtk={{$viewData['selectCharaState']['choAtk']}}&paaAtk={{$viewData['selectCharaState']['paaAtk']}}">
		<img src="{{SERVER_URL}}img/popup/popupbutton.png">
		<p>する</p>
	</a>
	</div>
</div>