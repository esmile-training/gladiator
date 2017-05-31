@include('common/css', ['file' => 'battleSelect'])
よろしいですか？
<a href="{{APP_URL}}battle/preparationBattle?arenaDifficulty={{$arenaData['id']}}
	&selectedCharaId={{$arenaData['selectedCharaId']}}">
	<img class= "battle_popupYesButton image_change" 
		 src="{{IMG_URL}}popup/yes_Button.png">
</a>