@include('common/css', ['file' => 'battleArenaSelect'])

<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
{{--対戦データの表示--}}
<div>				
	<img class = "battle_load backload"src = "{{IMG_URL}}title/titlelodoDown.gif">
</div>
<div class="match_data editload">
	{{--大会名の表示--}}
	<div class="arena_name_caption font_serif">選択した闘技場</div>
	<div class="arena_name">
		<img src="{{IMG_URL}}battle/difficulty{{$arenaData['id']}}.png" alt="闘技場名">
	</div>
	<div class="select_chara_caption font_serif">出場する剣闘士</div>

	{{--キャラの表示--}}
	<div class="popup_cahra_position">
		<div class="popup_chara_size">
			<img class="chara_button_frame" src="{{IMG_URL}}battle/chara_button_frame{{$arenaData['rarity']}}.png" alt="ボタンの下地">
			{{--キャラアイコン--}}
			<div class="chara_icon">
				{{--キャライメージ--}}
				<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$arenaData['imageId']}}.png" alt="キャラアイコン">
				{{--レアリティの表示--}}
				<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
				<img class="rarity" src="{{IMG_URL}}gacha/{{$arenaData['rarity']}}.png" alt="レアリティ">
			</div>
			{{--ステータスの表示--}}
			<div class="chara_status">
				{{--名前の表示--}}
				<font class="popup_chara_name font_serif">{{$arenaData['charaName']}}</font>
				{{--hpの表示--}}
				<font class="popup_hp_value font_sentury">{{$arenaData['hp']}}</font>
				{{--手の表示--}}
				<font class="popup_goo_value font_sentury">{{$arenaData['gooAtk']}}</font>
				<font class="popup_cho_value font_sentury">{{$arenaData['choAtk']}}</font>
				<font class="popup_paa_value font_sentury">{{$arenaData['paaAtk']}}</font>
			</div>
		</div>
	</div>

	{{--決定ボタン--}}
	<div class="submit_button load">
		<a href="{{APP_URL}}battle/preparationBattle?arenaDifficulty={{$arenaData['id']}}
			&selectedCharaId={{$arenaData['selectedCharaData']}}">
			<img class= "popup_decision_button image_change"
				src="{{IMG_URL}}popup/battleStart.png">
		</a>
	</div>
</div>
