@include('common/css',['file' => 'presentbox'])

<div class="present_all">
@foreach($viewData['presentData'] as $key => $val)
	@if($val['type'] == 1)
	{
		<div class="present_button">
			<div class="present_flame">
				<img src="{{IMG_URL}}shop/product_Flame.png">
				<div class="present_chara_icon">
					<img src="{{IMG_URL}}chara/{{$val['imgId']}}.png">
				</div>
			</div>
		</div>
	}@else if($val['type'] == 2){
		<div class="present_button">
			<div class="present_flame">
				<img src="{{IMG_URL}}shop/product_Flame.png">
				<div class="present_item_icon">
					<img src="{{IMG_URL}}item/item{{$val['imgId']}}.png">
				</div>
			</div>
		</div>
	}
	@endif
@endforeach
</div>
