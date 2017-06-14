{{-- CSS --}}
@include('common/css', ['file' => 'coachRetirement'])
@include('common/js',['file' => 'no'])

<div style="margin-bottom: 10%;">
	<center>コーチに配属しますか？</center>
</div>
<div class="popup_all">
	<img class = "popup_charaframe" src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
	<div class="popup_name">
		<font>{{$coach['name']}}</font>
	</div>
	<div class="popup_framein">
		<img class = "popup_chara" src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
		{{--レアリティの表示--}}
		<img class="popup_rarityback" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
		<img class="popup_rarity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
	</div>
	<div class="popup_goo">
		{{$coach['gooAtk']}}
	</div>
	<div class="popup_cho">
		{{$coach['choAtk']}}
	</div>
	<div class="popup_paa">
		{{$coach['paaAtk']}}
	</div>
</div>
	<div>
	↓
	</div>
<div>
			{{--キャラボタン--}}
			<div class="popup_all">
				<img class = "popup_charaframe"src="{{IMG_URL}}battle/chara_button_frame{{$viewData['selectCharaState']['rare']}}.png" alt="ボタンの下地">

				{{--キャラアイコン--}}
				<div class="popup_framein">
					{{--キャライメージ--}}
					<img class="popup_chara" src="{{IMG_URL}}chara/icon/icon_{{$viewData['selectCharaState']['imgId']}}.png" alt="キャラアイコン">

					{{--レアリティの表示--}}
					<img class="popup_rarityback" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
					<img class="popup_rarity" src="{{IMG_URL}}gacha/{{$viewData['selectCharaState']['rare']}}.png" alt="レアリティ">
				</div>
				{{--名前の表示--}}
				<div class="popup_charaname">
					{{$viewData['selectCharaState']['name']}}
				</div>
				{{--hpの表示--}}
				<div class="popup_charahp">
					{{$viewData['selectCharaState']['hp']}}
				</div>
				{{--手の表示--}}
				<div class="popup_charagoo">
					{{$viewData['selectCharaState']['gooAtk']}}
				</div>
				<div class="popup_characho">
					{{$viewData['selectCharaState']['choAtk']}}
				</div>
				<div class="popup_charapaa">
					{{$viewData['selectCharaState']['paaAtk']}}
				</div>
			</div>
</div>
	<br>
	<div>
		<a class=" " href="{{APP_URL}}ChangeCoachSelect/changeCoach?coachId={{$coach['id']}}&id={{$viewData['selectCharaState']['id']}}&imgId={{$viewData['selectCharaState']['imgId']}}&name={{$viewData['selectCharaState']['name']}}&rare={{$viewData['selectCharaState']['rare']}}&attribute={{$viewData['selectCharaState']['attribute']}}&hp={{$viewData['selectCharaState']['hp']}}&gooAtk={{$viewData['selectCharaState']['gooAtk']}}&choAtk={{$viewData['selectCharaState']['choAtk']}}&paaAtk={{$viewData['selectCharaState']['paaAtk']}}">
			<img class="image_change popup_yesbutton" src="{{IMG_URL}}popup/yes_Button.png" alt="はい"/>
		</a>
		<a class="no">
			<img class="image_change popup_nobutton" src="{{IMG_URL}}popup/no_Button.png" alt="いいえ"/>
		</a>
	</div>