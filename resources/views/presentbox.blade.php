<div><img class="present_back" src="{{IMG_URL}}background/almighty.jpg" /></div>
@include('common/css',['file' => 'presentbox'])

<div class="present_signboard">
	<img src="{{IMG_URL}}signboard/presentbox.png">
</div>
<div class="present_signboard_info">
	<img src="{{IMG_URL}}signboard/info.png">
</div>
@if(!is_null($viewData['presentData']))
	<div class="present_receive_all_button">
		<a href="{{APP_URL}}presentbox/setPresentData?receiveId=0">
			<img src="{{IMG_URL}}presentbox/receiveAllButton.png">
		</a>
	</div>
	<div class="present_all">
		@foreach($viewData['presentData'] as $key => $val)
			<div class="present_button">
				<div class="present_flame">
					<img src="{{IMG_URL}}presentbox/button_flame.png">
					@if($val['type'] == 1)
						<div class="present_button_item_text presentbox_text">入団待ちの剣闘士</div>
						<div class="present_chara_icon">
							<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png">
						</div>
					@elseif($val['type'] == 2)
						<div class="present_button_item_text presentbox_text">{{$viewData['itemData'][$val['objId']]['name']}}×{{$val['cnt']}}個</div>
						<div class="present_item_icon">
							<img src="{{IMG_URL}}item/item{{$val['imgId']}}.png">
						</div>
					@else
						<div class="present_button_item_text presentbox_text">{{$val['cnt']}}G</div>
						<div class="present_item_icon">
							<img src="{{IMG_URL}}user/gold.png">
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
@else
	<div class="presentbox_text no_present_text">受け取れるアイテムはありません</div>
@endif
