<div><img class="present_back" src="{{IMG_URL}}gacha/gachabackground.jpg" /></div>
@include('common/css',['file' => 'presentbox'])

<div class="present_signboard">
	<img src="{{IMG_URL}}signboard/presentbox.png">
</div>
<div class="present_signboard_info">
	<img src="{{IMG_URL}}signboard/info.png">
</div>

@if(isset($viewData['presentData']))
	<div class="present_all">
		<div class="present_receive_all_button">
			<a href="{{APP_URL}}presentbox/setPresentData?receiveId=0">
				<img src="{{IMG_URL}}presentbox/receiveAllButton.png">
			</a>
		</div>
		@foreach($viewData['presentData'] as $key => $val)
			<div class="present_button">
				<div class="present_flame">
					<img src="{{IMG_URL}}presentbox/button_flame.png">
					@if($val['type'] == 1)
						<div class="present_chara_icon">
							<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png">
						</div>
					@elseif($val['type'] == 2)
						<div class="present_item_icon">
							<img src="{{IMG_URL}}item/item{{$val['imgId']}}.png">
						</div>
					@else
						<div class="present_item_icon">
							<img src="{{IMG_URL}}item/item{{$val['imgId']}}.png">
						</div>
					@endif
					<div class="present_receive_button">
						<a href="{{APP_URL}}presentbox/setPresentData?receiveId={{$val['id']}}&type={{$val['type']}}&objId={{$val['objId']}}&cnt={{$val['cnt']}}">
							<img src="{{IMG_URL}}presentbox/receiveButton.png">
						</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endif
