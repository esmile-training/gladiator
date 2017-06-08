{{--CSS--}}
@include('common/css', ['file' => 'shop'])

{{-- 背景 --}}
<div>
	<img class="shop_back" src="{{IMG_URL}}gacha/gachabackground.jpg" />
</div>

{{-- 看板 --}}
<div class="shop_signboard_info">
	<img src="{{IMG_URL}}/shop/signboard_info.png">
	<div class ="shop_signboard_text">
		<font class="shop_font_serif">{{'購入アイテムを選択'}}</font>
	</div>
</div>
{{-- 看板説明 --}}
<div class="shop_signboard">
	<img src="{{IMG_URL}}shop/signboard.png">
</div>

{{-- アイテム一覧 --}}
<div class="item_list">
	@foreach( $viewData['productData'] as $key => $val)
		{{-- ボタン間隔を空けて表示 --}}
		<div class="item_list_button_margin">
			{{-- チケットのボタン --}}
			<div class="item_list_button">
				<a>
					<img class="modal_btn purchaseButton{{$val['id']}} item_list_button_img" src="{{IMG_URL}}shop/productButton{{$val['id']}}.png">
					<div class="item_list_button_name">
						{{$viewData['itemData'][$val['id']]['name']}}
						{{$viewData['productData'][$val['id']]['price']}}
					</div>
				</a>
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
