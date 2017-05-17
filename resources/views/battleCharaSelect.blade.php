{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/08
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
		キャラクターを選択して下さい
</div>

{{--所持キャラクターをすべて表示する--}}
<form action="{{APP_URL}}battle/selectArena" method="get">
	<div>
		@foreach($viewData['charaList'] as $chara)
			<input type="image" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png" alt="キャライメージ"
				   name="uCharaId" value="{{$chara['id']}}" width="75" height="100">{{$chara['name']}}<br>
		@endforeach
	</div>
</form>