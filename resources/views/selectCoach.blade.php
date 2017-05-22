@include('common/css', ['file' => 'chara'])
<div>
	<center>
	コーチ枠がいっぱいです<br>
	交代するコーチを選んでください<br>
	<br>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>
<?php $count = 0; ?>
<div>
	@foreach($viewData['coachList'] as $coach)
	<?php if($coach['state'] == 1) { ?>
	<div align="center">
		<font color="silver">訓練中<font>
		<image class='coach' src="{{IMG_URL_CHARA}}{{$coach['imgId']}}.png">{{$coach['name']}}
	</div>
	<?php } else { ?>
	{{-- popupボタン --}}
	<div class="modal_container">
		<input type='image' class="modal_btn confirmChangeCoach{{ $count }}" src="{{IMG_URL_CHARA}}{{$coach['imgId']}}.png" width="75" height="100">{{$coach['name']}}
	</div>
	{{-- popupウインドウ --}}
	<div class="modal confirmChangeCoach{{ $count }}">
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
				@include('popup/confirmChangeCoach')
			</div>
		</div>
		<div class="modal_bottom">
			<img class="modal_framebottom"src="{{SERVER_URL}}img/popup/popupbottom.png">
		</div>
	</div>				
	<input type="hidden" name="charaId" value="{{$_GET['id']}}">
	<?php $count++; ?>
	<?php } ?>
	@endforeach
</div>
<br>
<div align="center">
<form action ="deleteChara" method="get">
	<input type="hidden" name="id" value="{{$_GET['id']}}">
	<button type="submit" >コーチにしない</button>
</form>
	<button type="button" onclick="history.back()">戻る</button>
</div>

