{{--/*
 * 闘技場選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/08
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
		闘技場を選択して下さい
</div>

{{--大会の一覧を表示する--}}
<form action="{{APP_URL}}battle/preparationBattle" method="get">
	<div>
		@foreach($viewData['difficultyList'] as $arena)
			<input type="radio" name="arenaDifficulty" value="{{$arena}}" >{{$arena}}<br>
		@endforeach
		<input type="hidden" name="selectedCharaId" value="{{$viewData['selectedCharaId']}}">
		<input type="submit" value="決定">
	</div>
</form