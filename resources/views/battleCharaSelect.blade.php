{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/06/06
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleCharaSelect'])

{{--所持キャラクターをすべて表示する--}}
@if(!is_null($viewData['charaList']))
<div class="chara_list">
	@foreach($viewData['charaList'] as $chara)
	{{--ボタンの表示間隔--}}
		<div class="button_margin">
			<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}">

				{{--キャラボタン--}}
				<div class="chara_button">
					<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$chara['rare']}}.png" alt="ボタンの下地">

					{{--キャラアイコン--}}
					<div class="chara_icon">

						{{--キャライメージ--}}
						<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">

						{{--レアリティの表示--}}
						<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
						<img class="rarity" src="{{IMG_URL}}gacha/{{$chara['rare']}}.png" alt="レアリティ">
					</div>

					{{--ステータスの表示--}}
					<div class="chara_status">
						{{--名前の表示--}}
						<font class="chara_name font_serif">{{$chara['name']}}</font>
						{{--hpの表示--}}
						<font class="hp_value font_sentury">{{$chara['hp']}}</font>
						{{--手の表示--}}
						<font class="goo_value font_sentury">{{$chara['gooAtk']}}</font>
						<font class="cho_value font_sentury">{{$chara['choAtk']}}</font>
						<font class="paa_value font_sentury">{{$chara['paaAtk']}}</font>
					</div>

				</div>
			</a>
		</div>
	@endforeach
</div>
@else
<div class = "no_chara">
	所属している剣闘士が０人です！
</div>
@endif
<img class="signboard_img" src="{{IMG_URL}}battle/signboard.png" alt="看板">
