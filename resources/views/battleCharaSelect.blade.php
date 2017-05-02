{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/27
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
		キャラクター一覧
</div>

{{--所持キャラクターをすべて表示する--}}
<form action="{{APP_URL}}selectChara/selectArena" method="get">
	<div>
		@foreach($viewData['charaList'] as $chara)
			<input type="image" src="{{CHAR_IMG_URL}}{{$chara['imgId']}}.png" alt="キャライメージ"<
			name="uCharaId" value="{{$chara['id']}}" width="75" height="100">{{$chara['name']}}<br>
			{{--var_dump($chara)--}}
		@endforeach
	</div>
</form>