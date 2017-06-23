{{--/*
 * 闘技場選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/06/06
 */--}}

{{-- css  --}}
@include('common/css', ['file' => 'battleArenaSelect'])
@include('common/css', ['file' => 'battleCharaSelect'])
<div><img class="battle_arena_selectback" src="{{IMG_URL}}background/almighty.jpg" /></div>
{{--大会の一覧を表示する--}}
<div class="arena_list">
	@foreach($viewData['difficultyList'] as $arena)
			<div class = "arena_banner{{$arena['id']}}">
				<img class ="modal_btn arena{{$arena['id']}}" src="{{IMG_URL}}battle/difficulty{{$arena['id']}}.png">
			</div>
			<?php
				$arenaData['selectedCharaData']		= $viewData['selectedCharaData']['uCharaId'];
				$arenaData['rarity']				= $viewData['selectedCharaData']['rarity'];
				$arenaData['imageId']				= $viewData['selectedCharaData']['imageId'];
				$arenaData['charaName']				= $viewData['selectedCharaData']['name'];
				$arenaData['hp'] 					= $viewData['selectedCharaData']['hp'];
				$arenaData['gooAtk']				= $viewData['selectedCharaData']['gooAtk'];
				$arenaData['choAtk']				= $viewData['selectedCharaData']['choAtk'];
				$arenaData['paaAtk']				= $viewData['selectedCharaData']['paaAtk'];
				$arenaData['id']					= $arena['id'];
				$arenaData['arenaName']				= $arena['name'];
			?>
	{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> "arena{$arena['id']}",
	'template'	=> 'arenaSelect',
	'data'	=>	['arenaData' => $arenaData]
])
	@endforeach
	{{--インフォ--}}
	<div class="arena_select_signboard_info">
		<img src="{{IMG_URL}}signboard/info.png">
		<div class ="arena_select_signboard_text">
			<font  class="arena_select_text font_serif">闘技場を選択してください</font>
		</div>
	</div>
	{{--看板の表示--}}
	<img class="signboard_img" src="{{IMG_URL}}signboard/battle.png" alt="看板">
</div>
