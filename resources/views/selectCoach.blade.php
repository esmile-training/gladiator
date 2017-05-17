<div>
	<center>
	コーチ枠がいっぱいです<br>
	交代するコーチを選んでください<br>
	<br>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>
<form action="setCoach" method="get">
	<?php $count = 0; ?>
	<div>
		@foreach($viewData['coachList'] as $coach)
			<img src="{{IMG_URL_CHARA}}{{$coach['imgId']}}.png" width="75" height="100">{{$coach['name']}}<br>
			<br>
			{{-- popupボタン --}}
			<div class="modal_container">
				<span class="modal_btn confirmChangeCoach{{ $count }}">Show modal</span>
			</div>
			
			{{-- popupウインドウ --}}
			<div class="modal confirmChangeCoach{{ $count }}">
			@include('popup/confirmChangeCoach')
				<div class="modal_frame">
						<div class="close">
						<span>close</span>
					</div>
				</div>
			</div>
				
			<input type="hidden" name="charaId" value="{{$_GET['id']}}">
		@endforeach
	</div>
</form>

<form action ="deleteChara" method="get">
	<input type="hidden" name="id" value="{{$_GET['id']}}">
	<button type="submit" >コーチにしない</button>
</form>
<button type="button" onclick="history.back()">戻る</button>
