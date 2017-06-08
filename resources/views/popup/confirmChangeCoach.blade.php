{{-- CSS --}}
@include('common/css', ['file' => 'confirmChangeCoach'])
@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/css', ['file' => 'coachSelect'])
@include('common/css', ['file' => 'training'])
@include('common/js',['file' => 'no'])

<div>
	<center>コーチに配属しますか？</center>
</div>
<div class="training_coach_window">
	<img src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
	<div class="coachSelect_text training_coach_name" style="font-size: 4vw;">
		<font>{{$coach['name']}}</font>
	</div>
	<div class="training_coach_icon">
		<img src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
		{{--レアリティの表示--}}
		<img class="coachSelect_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
		<img class="coachSelect_rerity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
	</div>
	<div class="coachSelect_text training_coach_goo_atk">
		{{$coach['gooAtk']}}
	</div>
	<div class="coachSelect_text training_coach_cho_atk">
		{{$coach['choAtk']}}
	</div>
	<div class="coachSelect_text training_coach_paa_atk">
		{{$coach['paaAtk']}}
	</div>
</div>
<div>
	↓
</div>
<div>
	{{--キャラボタン--}}
	<div class="chara_button" style="transform: scale(0.9); width: none;">
		<img src="{{IMG_URL}}battle/chara_button_frame{{$viewData['selectCharaState']['rare']}}.png" alt="ボタンの下地">

		{{--キャラアイコン--}}
		<div class="chara_icon">

			{{--キャライメージ--}}
			<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$viewData['selectCharaState']['imgId']}}.png" alt="キャラアイコン">

			{{--レアリティの表示--}}
			<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
			<img class="rarity" src="{{IMG_URL}}gacha/{{$viewData['selectCharaState']['rare']}}.png" alt="レアリティ">
		</div>

		{{--ステータスの表示--}}
		<div class="chara_status">
			{{--名前の表示--}}
			<font class="chara_name font_serif" style="font-size: 4vw;">{{$viewData['selectCharaState']['name']}}</font>
			{{--hpの表示--}}
			<font class="hp_value font_sentury">{{$viewData['selectCharaState']['hp']}}</font>
			{{--手の表示--}}
			<font class="goo_value font_sentury">{{$viewData['selectCharaState']['gooAtk']}}</font>
			<font class="cho_value font_sentury">{{$viewData['selectCharaState']['choAtk']}}</font>
			<font class="paa_value font_sentury">{{$viewData['selectCharaState']['paaAtk']}}</font>
		</div>
	</div>
</div>
<br>
<div>
	<a class="button retire" href="{{APP_URL}}SelectCoach/changeCoach?coachId={{$coach['id']}}&id={{$viewData['selectCharaState']['id']}}&imgId={{$viewData['selectCharaState']['imgId']}}&name={{$viewData['selectCharaState']['name']}}&rare={{$viewData['selectCharaState']['rare']}}&attribute={{$viewData['selectCharaState']['attribute']}}&hp={{$viewData['selectCharaState']['hp']}}&gooAtk={{$viewData['selectCharaState']['gooAtk']}}&choAtk={{$viewData['selectCharaState']['choAtk']}}&paaAtk={{$viewData['selectCharaState']['paaAtk']}}">
		<img class="image_change" src="{{IMG_URL}}popup/yes_Button.png" alt="はい"/>
	</a>
	<a class="button back">
		<img class="image_change no" src="{{IMG_URL}}popup/no_Button.png" alt="いいえ"/>
	</a>
</div>