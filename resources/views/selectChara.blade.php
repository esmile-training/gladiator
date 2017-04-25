{{--/*
 * キャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/04/21
 */--}}


{{--キャラ選択ビュー--}}
<link href="{{APP_URL}}css/top.css?var={{time()}}" rel="stylesheet" type="text/css">

<div>
		キャラクター一覧
</div>

{{--所持キャラクターをすべて表示する--}}
<form action="{{APP_URL}}selectChara/setChara" method="get">
		<div>
				@foreach($viewData['charaList'] as $chara)
						<input type="radio" name="uCharaId" value="{{$chara['id']}}">{{$chara['cName']}}<br>
						{{var_dump($chara)}}
				@endforeach
				<input type="submit" value="決定">
		</div>
</form>