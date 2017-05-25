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
		<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}">
			{{--ボタンの枠--}}
			<div class="chara_frame">
				<img class="chara_frame_img" src="{{IMG_URL}}battle/chara_button_frame.png" alt="ボタンの枠">
				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png"
					alt="キャラアイコン">
				</div>
				{{--キャラ名--}}
				<font class="chara_name">{{$chara['name']}}</font>
			</div>
		</a>
	</div>
@endforeach
