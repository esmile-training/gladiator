{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/29
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleCharaSelect'])

{{--所持キャラクターをすべて表示する--}}

<div class="chara_list">
	@foreach($viewData['charaList'] as $chara)
	{{--ボタンの表示間隔--}}
		<div class="button_margin">
			<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}">

				{{--キャラボタン--}}
				<div class="chara_button">
					<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの下地">

					{{--キャラアイコン--}}
					<div class="chara_icon">

						{{--アイコンの外枠--}}
						<div class="icon_frame_margin">
							<img class="icon_frame" src="{{IMG_URL}}battle/icon_frame{{$chara['iconFrame']}}.png" alt="キャラアイコンの枠">
						</div>

						{{--キャライメージ--}}
						<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">

						{{--レアリティの表示--}}
						<img class="rarity_bg" src="{{IMG_URL}}gacha/logoflash.png" alt="レアリティの背景">
						<img class="rarity" src="{{IMG_URL}}gacha/{{$chara['rare']}}.png" alt="レアリティ">
					</div>

					{{--ステータスの表示--}}
					<div class="chara_status">
						{{--名前の表示--}}
						<font class="chara_name font_serif">{{$chara['name']}}</font>
						{{--hpの表示--}}
						<img class="hp_icon" src="{{IMG_URL}}chara/status/hp.png" alt="HPアイコン">
						<font class="hp_value font_color_green font_sentury">{{$chara['hp']}}</font>
						{{--手の表示--}}
						<img class="goo_icon" src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
						<font class="goo_value font_sentury">{{$chara['gooAtk']}}</font>
						<img class="cho_icon" src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
						<font class="cho_value font_sentury">{{$chara['choAtk']}}</font>
						<img class="paa_icon" src="{{IMG_URL}}chara/status/hand3.png" alt="パーアイコン">
						<font class="paa_value font_sentury">{{$chara['paaAtk']}}</font>
					</div>

				</div>
			</a>
		</div>
	@endforeach
</div>
<img class="signboard_img" src="{{IMG_URL}}battle/signboard.png" alt="ボタンの下地">
