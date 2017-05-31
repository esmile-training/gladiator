{{-- CSS --}}
@include('common/css', ['file' => 'confirmChangeCoach'])
@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/js',['file' => 'no'])

<div>
	<center>コーチに配属しますか？</center>
</div>
<div class='chara_button'>
	<div class="chara_frame reduction">
		<img class="chara_frame_img" src="{{IMG_URL}}training/coachButton.png" alt="ボタンの枠">
		{{--キャラアイコン--}}
		<div class="chara_icon">
			<img src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png" alt="キャラアイコン">
		</div>
		{{--HP--}}
		<div class="hp_icon">
			<img src="{{IMG_URL}}chara/status/hp.png" alt="HPアイコン">
		</div>
		<div class="hp_value">
			<font>{{$coach['hp']}}</font>
		</div>
		{{--グー--}}
		<div class="goo_icon">
			<img src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
		</div>
		<div class="status_value goo_pos">
			<font>{{$coach['gooAtk']}}</font>
		</div>

		{{--チョキ--}}
		<div class="cho_icon">
			<img src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
		</div>
		<div class="status_value cho_pos">
			<font>{{$coach['choAtk']}}</font>
		</div>

		{{--パー--}}
		<div class="paa_icon">
			<img src="{{IMG_URL}}chara/status/hand3.png" alt="チョキアイコン">
		</div>
		<div class="status_value paa_pos">
			<font>{{$coach['paaAtk']}}</font>
		</div>

		{{--キャラ名--}}
		<font class="chara_name">{{$coach['name']}}</font>
	</div>
	<div>
	↓
	</div>
	<div class="chara_frame reduction">
		<img class="chara_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの枠">

		{{--キャラアイコン--}}
		<div class="chara_icon">
			<img src="{{IMG_URL}}chara/icon/icon_{{$viewData['selectCharaState']['imgId']}}.png"
			alt="キャラアイコン">
		</div>
		{{--HP--}}
		<div class="hp_icon">
			<img src="{{IMG_URL}}chara/status/hp.png"
			alt="HPアイコン">
		</div>
		<div class="hp_value">
			<font>{{$viewData['selectCharaState']['hp']}}</font>
		</div>
		{{--グー--}}
		<div class="goo_icon">
			<img src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
		</div>
		<div class="status_value goo_pos">
			<font>{{$viewData['selectCharaState']['gooAtk']}}</font>
		</div>
		{{--チョキ--}}
		<div class="cho_icon">
			<img src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
		</div>
		<div class="status_value cho_pos">
			<font>{{$viewData['selectCharaState']['choAtk']}}</font>
		</div>

		{{--パー--}}
		<div class="paa_icon">
			<img src="{{IMG_URL}}chara/status/hand3.png" alt="チョキアイコン">
		</div>
		<div class="status_value paa_pos">
			<font>{{$viewData['selectCharaState']['paaAtk']}}</font>
		</div>

		{{--キャラ名--}}
		<font class="chara_name">{{$viewData['selectCharaState']['name']}}</font>
	</div>
	<br>
	<div>
		<a class="button retire" href="{{APP_URL}}SelectCoach/changeCoach?coachId={{$coach['id']}}&id={{$viewData['selectCharaState']['id']}}&imgId={{$viewData['selectCharaState']['imgId']}}&name={{$viewData['selectCharaState']['name']}}&rare={{$viewData['selectCharaState']['rare']}}&attribute={{$viewData['selectCharaState']['attribute']}}&hp={{$viewData['selectCharaState']['hp']}}&gooAtk={{$viewData['selectCharaState']['gooAtk']}}&choAtk={{$viewData['selectCharaState']['choAtk']}}&paaAtk={{$viewData['selectCharaState']['paaAtk']}}">
			<img class="image_change" src="{{SERVER_URL}}img/popup/yes_Button.png" alt="はい"/>
		</a>
		<a class="button back">
			<img class="image_change no" src="{{SERVER_URL}}img/popup/no_Button.png" alt="いいえ"/>
		</a>
	</div>
</div>