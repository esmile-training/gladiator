{{--/*
 * 闘技場選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/05/25
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleSelect'])
{{--大会の一覧を表示する--}}
<div class="battle_select">
	<div class = "battle_selectfont">
		闘技場を選択して下さい
	</div>
	@foreach($viewData['difficultyList'] as $arena)
			<div class = "battle_select{{$arena['id']}}">	
				<img class ="modal_btn arena{{$arena['id']}}" src="{{IMG_URL}}battle/difficulty{{$arena['id']}}.png">
			</div>
			<?php 
				$arenaData['selectedCharaId'] = $viewData['selectedCharaId'];
				$arenaData['id'] = $arena['id'];
			?>
			{{-- popupウインドウ --}}
			@include('popup/wrap', [
				'class'		=> "arena{$arena['id']}", 
				'template'	=> 'arenaSelect',
				'data'	=>	['arenaData' => $arenaData]
			])
	@endforeach
</div>




