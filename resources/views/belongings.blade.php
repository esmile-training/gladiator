{{--CSS--}}
@include('common/css', ['file' => 'belongings'])
@include('common/css', ['file' => 'itemlist'])

{{-- 背景 --}}
<div>
	<img class="belongings_bg" src="{{IMG_URL}}shop/shop_Bg.jpg" />
</div>

{{-- 看板 --}}
<div class="belongings_signboard">
	<img src="{{IMG_URL}}shop/signboard.png">
</div>
{{-- 看板説明 --}}
<div class="belongings_signboard_info">
	<img src="{{IMG_URL}}/shop/signboard_info.png">
	<div class ="belongings_signboard_text">
		所持アイテム一覧
	</div>
</div>

{{-- 商品一覧 --}}
<div class="itemlist">
	@foreach( $viewData['itemData'] as $key => $val)
		{{-- ボタン間隔を空けて表示 --}}
		<div class="itemlist_margin">
			{{-- 商品の枠 --}}
			<div class="itemlist_flame">
				<img class="itemlist_flame_img" src="{{IMG_URL}}shop/product_Flame.png">
				
				{{-- アイテム画像 --}}
				<div class="itemlist_flame_item">
					@if( $val['id'] == 1)
						<img class="itemlist_flame_item_img" src="{{IMG_URL}}user/battleTicket.png" />
					@else
						<img class="itemlist_flame_item_img" src="{{IMG_URL}}item/item{{$val['id']}}.png" />
					@endif
				</div>
				{{-- アイテム名前 --}}
				<div class="itemlist_flame_name">
					{{$val['name']}}
				</div>
				{{-- アイテム所持数 --}}
				<div class="itemlist_flame_belongings">
					@if( $val['id'] == 1)
						{{$viewData['ticketData']['battleTicket']}}
					@else
						{{$viewData['belongingsData'][$val['dbName']]}}
					@endif
				</div>
				{{-- アイテム説明 --}}
			</div>
		</div>
	@endforeach
</div>
