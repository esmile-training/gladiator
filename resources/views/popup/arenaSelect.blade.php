@include('common/css', ['file' => 'battleArenaSelect'])
よろしいですか？
<a href="{{APP_URL}}battle/preparationBattle?arenaDifficulty={{$arenaData['id']}}
	&selectedCharaId={{$arenaData['selectedCharaId']}}">
	<img class= "battle_popupYesButton image_change"
		 src="{{IMG_URL}}popup/yes_Button.png">
</a>
