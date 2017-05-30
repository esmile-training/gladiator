{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/25
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleCharaSelect'])

{{--所持キャラクターをすべて表示する--}}

@foreach($viewData['charaList'] as $chara)
	<div class = "chara_button">
		{{--ボタンの枠--}}
		<div class="chara_frame">
			<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}">
				<img class="chara_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの枠">

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png"
					alt="キャラアイコン">
				</div>

				{{--グー--}}
				<div class="goo_icon">
					<img src={{IMG_URL}}chara/status/hand1.png>
				</div>
				<div class="status_value goo_pos">
					<font>{{$chara['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="cho_icon">
					<img src={{IMG_URL}}chara/status/hand2.png>
				</div>
				<div class="status_value cho_pos">
					<font>{{$chara['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="paa_icon">
					<img src={{IMG_URL}}chara/status/hand3.png>
				</div>
				<div class="status_value paa_pos">
					<font>{{$chara['paaAtk']}}</font>
				</div>

				{{--キャラ名--}}
				<font class="chara_name">{{$chara['name']}}</font>
			</a>
		</div>
	</div>
@endforeach
