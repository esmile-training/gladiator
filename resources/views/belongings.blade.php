{{--CSS--}}
@include('common/css', ['file' => 'shop'])

{{-- 背景 --}}
<div>
	<img class="shop_bg" src="{{IMG_URL}}shop/shop_Bg.jpg" />
</div>

{{-- 看板 --}}
<div class="shop_signboard">
	<img src="{{IMG_URL}}shop/signboard.png">
</div>
{{-- 看板説明 --}}
<div class="shop_signboard_info">
	<img src="{{IMG_URL}}/shop/signboard_info.png">
	<div class ="shop_signboard_text">
		所持アイテム一覧
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
					<img class="itemlist_flame_item_img" src="{{IMG_URL}}item/item{{$val['id']}}.png" />
				</div>
				{{-- アイテム名前 --}}
				<div class="itemlist_flame_name">
					{{$val['name']}}
				</div>
				{{-- アイテム所持数 --}}
				<div class="itemlist_flame_belongings">
					{{$viewData['belongingsData'][$viewData['itemData'][$val['itemId']]['name']]}}
				</div>
			</div>
		</div>
	@endforeach
</div>
