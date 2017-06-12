<div class="modal {{$class}}">
	<div class="modal_top">
		<img class="modal_frametop"src="{{IMG_URL}}popup/popuptop.png">
		<div class='modal_window'>
			@if(isset($data))
				@include('popup/'.$template, $data)
			@else
				@include('popup/'.$template)
			@endif
		</div>
		<div class="close editload">
			<img src="{{IMG_URL}}popup/closebutton.png">
			<span>close</span>
		</div>
	</div>
	<div class="modal_middle">
		<img class="modal_framemiddle"src="{{IMG_URL}}popup/popupmiddle.png">
	</div>
	<div class="modal_bottom">
		<img class="modal_framebottom"src="{{IMG_URL}}popup/popupbottom.png">
	</div>
</div>
