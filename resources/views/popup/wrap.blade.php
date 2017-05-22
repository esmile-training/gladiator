	<div class="modal {{$class}}">
        <div class="modal_top">
			<img class="modal_frametop"src="{{SERVER_URL}}img/popup/popuptop.png">
			<div class="close">
				<img class="modal_closebutton"src="{{SERVER_URL}}img/popup/closebutton.png">
                <span>close</span>
            </div>
        </div>
		<div class="modal_middle">
			<img class="modal_framemiddle"src="{{SERVER_URL}}img/popup/popupmiddle.png">
				<div class='modal_window'>
					@if(isset($data))
						@include('popup/'.$template, $data)
					@else
						@include('popup/'.$template)
					@endif
				</div>
		</div>
		<div class="modal_bottom">
			<img class="modal_framebottom"src="{{SERVER_URL}}img/popup/popupbottom.png">
		 </div>
    </div>
