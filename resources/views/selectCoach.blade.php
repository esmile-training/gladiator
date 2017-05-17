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
		<div>
			<center>
				訓練中
				<image src="{{CHAR_IMG_URL}}{{$coach['imgId']}}.png" width="75" height="100">{{$coach['name']}}
			</center>
		</div>
		<?php } else { ?>
			{{-- popupボタン --}}
			<div class="modal_container">
				<input type='image' class="modal_btn confirmChangeCoach{{ $count }}" src="{{CHAR_IMG_URL}}{{$coach['imgId']}}.png" width="75" height="100">{{$coach['name']}}
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
			<?php $count++; ?>
		<?php } ?>
		@endforeach
	</div>

<form action ="deleteChara" method="get">
	<input type="hidden" name="id" value="{{$_GET['id']}}">
	<button type="submit" >コーチにしない</button>
</form>
<button type="button" onclick="history.back()">戻る</button>
