{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/29
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleCharaSelect'])

{{--所持キャラクターをすべて表示する--}}

@foreach($viewData['charaList'] as $chara)

	<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}">
		<div class = "chara_button">
			{{--ボタンの枠--}}
			<div class="chara_frame">
				<img class="chara_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの枠">

				{{--キャラアイコンのフレーム--}}
				<div class="icon_frame">
					<img src="{{IMG_URL}}battle/icon_frame{{$chara['iconFrame']}}.png" alt="キャラアイコンの枠">
				</div>

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png"
					alt="キャラアイコン">
				</div>

				{{--レアリティの後ろの光--}}
				<div class="flash">
					<img src="{{IMG_URL}}gacha/logoflash.png"
					alt="レアリティの背景">
				</div>

				{{--レアリティ--}}
				<div class="rarity">
					<img src="{{IMG_URL}}gacha/{{$chara['rare']}}.png"
					alt="レアリティ">
				</div>

				{{--HP--}}
				<div class="hp_icon">
					<img src="{{IMG_URL}}chara/status/hp.png"
					alt="HPアイコン">
				</div>
				<div class="hp_value">
					<font>{{$chara['hp']}}</font>
				</div>

				{{--グー--}}
				<div class="goo_icon">
					<img src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
				</div>
				<div class="status_value goo_pos">
					<font>{{$chara['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="cho_icon">
					<img src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
				</div>
				<div class="status_value cho_pos">
					<font>{{$chara['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="paa_icon">
					<img src="{{IMG_URL}}chara/status/hand3.png" alt="パーアイコン">
				</div>
				<div class="status_value paa_pos">
					<font>{{$chara['paaAtk']}}</font>
				</div>

					{{--キャラ名--}}
				<font class="chara_name">{{$chara['name']}}</font>
			</div>
		</div>
	</a>
@endforeach
