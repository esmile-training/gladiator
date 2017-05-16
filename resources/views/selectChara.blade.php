{{-- css  --}}
@include('common/css', ['file' => 'admin'])
@include('common/js', ['file' => 'admin'])

<div>
		キャラクター一覧
</div>

{{--所持キャラクターをすべて表示する--}}
<?php if(is_null($viewData['charaList'])){ 
	 echo '<div>'.'キャラクターがいません。','<div>';
	} else {
	$count = 1; ?>
	<div>
		@foreach($viewData['charaList'] as $chara)		
			{{-- popupボタン --}}
			<div class="modal_container">
				<input type='image' class="modal_btn charastatus{{ $count }}" src="{{CHAR_IMG_URL}}{{$chara['imgId']}}.png" width="75" height="100">{{$chara['name']}}
			</div>
			{{-- popupウインドウ --}}
			<div class="modal charastatus{{ $count }}">
				@include('popup/charastatus')
				<div class="modal_frame">
						<div class="close">
						<span>close</span>
					</div>
				</div>
			</div>
			<?php $count++; ?>
		@endforeach
<?php } ?>	
	</div>