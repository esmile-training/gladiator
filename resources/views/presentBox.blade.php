@include('common/css',['file' => 'presentBox'])


<div class="present_all">
@foreach($viewData['presentData'] as $key => $val)
	<div class="present_button">
		<div class="present_flame">
			<img src="{{IMG_URL}}training/coachButton.png">
			@if($val['type'] == 1)
			{
					<div class="present_icon">
						<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png">
					</div>
			}@else if($val['type'] == 2){
					<div class="present_icon">
						<img src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png">
					</div>
			}
			@endif
		</div>
	</div>
@endforeach
</div>
