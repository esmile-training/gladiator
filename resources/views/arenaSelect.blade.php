{{--/*
 * 闘技場選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/25
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])
@include('common/css', ['file' => 'battleSelect'])
<div>
		闘技場を選択して下さい
</div>
{{--大会の一覧を表示する--}}

<div>
	@foreach($viewData['difficultyList'] as $arena)
			<a href="{{APP_URL}}battle/preparationBattle?arenaDifficulty={{$arena['id']}}
			&selectedCharaId={{$viewData['selectedCharaId']}}">
			<img class = "battle_select"src="{{IMG_URL}}battle/difficulty{{$arena['id']}}.png">
			<br>
		</a>
	@endforeach
</div>
