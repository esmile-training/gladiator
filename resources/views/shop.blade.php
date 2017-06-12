{{--CSS--}}
@include('common/css', ['file' => 'shop'])

{{-- 背景 --}}
<div>
	<img class="shop_bg" src="{{IMG_URL}}gacha/gachabackground.jpg" />
</div>

{{-- 看板 --}}
<div class="shop_signboard">
	<img src="{{IMG_URL}}shop/signboard.png">
</div>
{{-- 看板説明 --}}
<div class="shop_signboard_info">
	<img src="{{IMG_URL}}/shop/signboard_info.png">
	<div class ="shop_signboard_text">
		購入するアイテムを選択
	</div>
</div>

{{-- 商品一覧 --}}
<div class="itemlist">
	@foreach( $viewData['productData'] as $key => $val)
		{{-- ボタン間隔を空けて表示 --}}
		<div class="itemlist_margin">
			{{-- 商品の枠 --}}
			<div class="itemlist_flame">
				<img class="itemlist_flame_img" src="{{IMG_URL}}shop/product_Flame.png">
				{{-- アイテム画像 --}}
				<div class="itemlist_flame_item">
					@if( $val['itemId'] == 1)
						<img class="itemlist_flame_item_img" src="{{IMG_URL}}user/battleTicket.png" />
					@else
						<img class="itemlist_flame_item_img" src="{{IMG_URL}}item/item{{$val['id']}}.png" />
					@endif
				</div>
				{{-- アイテム名前 --}}
				<div class="itemlist_flame_name">
					{{$val['name']}}
				</div>
				{{-- アイテム価格 --}}
				<div class="itemlist_flame_price">
					{{$val['price']}}
				</div>
				{{-- アイテム所持数 --}}
				<div class="itemlist_flame_belongings">
					@if( $val['itemId'] == 1)
						{{$viewData['ticketData']['battleTicket']}}
					@else
						{{$viewData['belongingsData'][$viewData['itemData'][$val['itemId']]['name']]}}
					@endif
				</div>
				{{-- 購入ボタン --}}
				@if ($val['id'] != 1)
					@if ($viewData['userData']['money'] < $val['price'])
						<div class="itemlist_flame_button">
							<img class="itemlist_flame_button_img" src="{{IMG_URL}}shop/purchase_ButtonDown.png">				
						</div>
					@else
						<div class="itemlist_flame_button">
							<img class="modal_btn purchaseButton{{$val['id']}} image_change itemlist_flame_button_img" src="{{IMG_URL}}shop/purchase_Button.png">				
						</div>
					@endif
				@else
					@if ($viewData['userData']['money'] < $val['price'] || $viewData['ticketData']['battleTicket'] >= 5)
						<div class="itemlist_flame_button">
							<img class="itemlist_flame_button_img" src="{{IMG_URL}}shop/purchase_ButtonNot.png">				
						</div>
					@else
						<div class="itemlist_flame_button">
							<img class="modal_btn purchaseButton{{$val['id']}} image_change itemlist_flame_button_img" src="{{IMG_URL}}shop/purchase_Button.png">				
						</div>
					@endif
				@endif
			</div>
		</div>
		{{-- 購入アイテムのデータ統合 --}}
		<?php
			$purchaseData['itemData']		= $viewData['itemData'][$val['id']];
			$purchaseData['productData']	= $viewData['productData'][$val['id']];
			$purchaseData['money']			= $viewData['userData']['money'];
		?>
		{{-- ポップアップの宣言 --}}
		@include('popup/wrap', [
			'class'		=> "purchaseButton{$val['id']}", 
			'template'	=> 'purchase',
			'data'		=>	['purchaseData' => $purchaseData]
		])
	@endforeach
</div>
