<div class="bonus_text">{{$loginBonusData['date']}}日目ログインボーナス!</div>

@if($loginBonusData['type'] == 2)
<div class='bonus_img'>
	<img src="{{IMG_URL}}item/item{{$loginBonusData['objId']}}.png">
</div>
<div class="bonus_text">{{$loginBonusData['name']}}を{{$loginBonusData['cnt']}}個プレゼント!</div>
@elseif($loginBonusData['type'] == 3)
<div class='bonus_img'>
	<img src="{{IMG_URL}}user/gold.png">
</div>
<div class="bonus_text">{{$loginBonusData['cnt']}}Gプレゼント!</div>
@endif

<div class="bonus_text bonus_info_text">※アイテムは受け取りBOXに送られます</div>