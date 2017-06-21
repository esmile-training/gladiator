<div class="battleItem2">
	<img class="battleItem_flame" src="{{IMG_URL}}battle/item_Popup_Flame.png">
	<img class="battleItem2_itemIcon" src="{{IMG_URL}}item/item2.png">
	<div class="battleItem2_name">
		{{$itemPopupData['itemData'][2]['name']}}
	</div>
	<div class="battleItem2_abilityInfo">
		{{$itemPopupData['itemData'][2]['abilityInfo']}}
	</div>
	<div class="battleItem2_number">
		{{$itemPopupData['belongingsData']['hpRecovery']}}
	</div>

	<a href="{{APP_URL}}item/item?itemId=2&battleCharaId={{$itemPopupData['charaData']['uBattleCharaId']}}&number=1" class="battleItem2_useButton clickfalse">
		<img class="useButton image_change" src="{{IMG_URL}}battle/use_Button.png">
	</a>
</div>

<div class="battleItem3">
	<img class="battleItem_flame" src="{{IMG_URL}}battle/item_Popup_Flame.png">
	<img class="battleItem3_itemIcon" src="{{IMG_URL}}item/item3.png">
	<div class="battleItem3_name">
		{{$itemPopupData['itemData'][3]['name']}}
	</div>
	<div class="battleItem3_abilityInfo">
		{{$itemPopupData['itemData'][3]['abilityInfo']}}
	</div>
	<div class="battleItem3_number">
		{{$itemPopupData['belongingsData']['atkUpper']}}
	</div>

	<a href="{{APP_URL}}item/item?itemId=3&battleCharaId={{$itemPopupData['charaData']['uBattleCharaId']}}&number=1" class="battleItem3_useButton clickfalse">
		<img class="useButton image_change" src="{{IMG_URL}}battle/use_Button.png">
	</a>
</div>