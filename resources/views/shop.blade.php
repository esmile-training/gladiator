{{--CSS--}}
@include('common/css', ['file' => 'shop'])

{{-- 背景 --}}
<div><img class="shop_back" src="{{IMG_URL}}gacha/gachabackground.jpg" /></div>

{{-- 看板 --}}
<div class="shop_signboard_info">
	<img src="{{IMG_URL}}/shop/signboard_info.png">
	<div class ="shop_signboard_text">
		<font class="shop_font_serif">{{'購入アイテムを選択'}}</font>
	</div>
</div>
{{-- 看板説明 --}}
<div class="shop_signboard">
	<img src="{{IMG_URL}}/shop/signboard.png">
</div>

{{-- アイテム一覧 --}}
<div class="item_list">
	{{-- ボタン間隔を空けて表示 --}}
	<div class="item_list_button_margin">
		{{-- チケットのボタン --}}
		<div class="item_list_button">
			<img class="item_list_button_img" src="{{IMG_URL}}/shop/ticket.png">
		</div>
	</div>
	{{-- ボタン間隔を空けて表示 --}}
	<div class="item_list_button_margin">
		{{-- 回復アイテムのボタン --}}
		<div class="item_list_button">
			<img class="item_list_button_img" src="{{IMG_URL}}/shop/hpRecovery.png">
		</div>
	</div>
	{{-- ボタン間隔を空けて表示 --}}
	<div class="item_list_button_margin">
		{{-- 攻撃力アップアイテムのボタン --}}
		<div class="item_list_button">
			<img class="item_list_button_img" src="{{IMG_URL}}/shop/atkUpper.png">
		</div>
	</div>
	{{-- ボタン間隔を空けて表示 --}}
	<div class="item_list_button_margin">
		{{-- 攻撃力アップアイテムのボタン --}}
		<div class="item_list_button">
			<img class="item_list_button_img" src="{{IMG_URL}}/shop/trainigShorter.png">
		</div>
	</div>
</div>
