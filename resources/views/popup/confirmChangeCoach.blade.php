{{-- CSS --}}
@include('common/css', ['file' => 'confirmChangeCoach'])
@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/js',['file' => 'no'])

<div>
	<center>コーチに配属しますか？</center>
</div>
<div class='chara_list'>
<div class="chara_frame" style='left: 2%'>
			{{-- popupボタン --}}
			{{--ボタンの表示間隔--}}
		<div class="button_margin">
			{{--ボタンの枠--}}
			<div class="modal_btn confirmChangeCoach{{ $count }} chara_button" style='left: 2%'>
				<image class="chara_button_frame_img" src='{{IMG_URL}}training/coachButton.png'>
			{{--キャラアイコン--}}
			<div class="chara_icon">
				{{--キャライメージ--}}
				<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png" alt="キャラアイコン">
				{{--レアリティの表示--}}
				<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
				<img class="rarity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
			</div>
			{{--ステータスの表示--}}
				<div class="chara_status">
					{{--名前の表示--}}
					<font class="chara_name font_serif">{{$coach['name']}}</font>
					{{--hpの表示--}}
					<font class="hp_value font_sentury">{{$coach['hp']}}</font>
					{{--手の表示--}}
					<font class="goo_value font_sentury">{{$coach['gooAtk']}}</font>
					<font class="cho_value font_sentury">{{$coach['choAtk']}}</font>
					<font class="paa_value font_sentury">{{$coach['paaAtk']}}</font>
				</div>
			</div>
	</div>
</div>
	<div>
	↓
	</div>
<div class="button_margin">
			{{--キャラボタン--}}
			<div class="chara_button">
				<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$viewData['selectCharaState']['rare']}}.png" alt="ボタンの下地">

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
					<font class="chara_name font_serif">{{$viewData['selectCharaState']['name']}}</font>
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
</div>