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
			<img src="{{CHAR_IMG_URL}}{{$chara['imgId']}}.png" width="75" height="100">{{$chara['name']}}<br>
			<br>
			{{-- popupボタン --}}
			<div class="modal_container">
				<span class="modal_btn charastatus{{ $count }}">Show modal</span>
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