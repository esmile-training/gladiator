@include('common/css', ['file' => 'chara'])
<div>
	<font color="silver">
	<center>
	コーチ枠がいっぱいです<br>
	交代するコーチを選ぶか、<br>
	引退を選んでください。<br>
	</font>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>
<?php $count = 0; ?>
<div>
	@foreach($viewData['coachList'] as $coach)
	@if($coach['state'] == 1)
		<div align="center">
			<font color="black">訓練中<font>
			<img class='coach' src="{{IMG_URL_CHARA}}icon/icon_{{$coach['imgId']}}.png">{{$coach['name']}}
		</div>
	@else
		{{-- popupボタン --}}
		<div class="modal_container">
			<input type='image' class="modal_btn confirmChangeCoach{{ $count }}" src="{{IMG_URL_CHARA}}icon/icon_{{$coach['imgId']}}.png" width="75" height="100">{{$coach['name']}}
		</div>
		{{-- popupウインドウ --}}
		@include('popup/wrap', [
		'class' => "confirmChangeCoach{$count}",
		'template' => 'confirmChangeCoach'
		])
		<?php $count++; ?>
	@endif
	@endforeach
</div>
<br>
<div>
<a href="{{APP_URL}}selectCoach/deleteChara?id={{$_GET['id']}}" style="width: 38%;">
	<img src="{{SERVER_URL}}img/popup/retire_Button.png" alt="引退">
</a>
<a onclick="history.back()" style="width: 38%;">
	<img src="{{SERVER_URL}}img/popup/back_Button.png" alt="戻る">
</a>
</div>