@include('common/css', ['file' => 'chara'])
@include('common/css', ['file' => 'battleCharaSelect'])
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
			訓練中
			<img class='coach' src="{{IMG_URL_CHARA}}icon/icon_{{$coach['imgId']}}.png">{{$coach['name']}}
		</div>
	@else
		{{-- popupボタン --}}
{{--ボタンの枠--}}
		<div class="modal_btn confirmChangeCoach{{ $count }} chara_frame">
			<input type='image' class="chara_frame_img" src='{{IMG_URL}}battle/chara_button_frame.png'>

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png"
					alt="キャラアイコン">
				</div>

				{{--グー--}}
				<div class="goo_icon">
					<img src="{{IMG_URL}}battle/hand1.png" alt="グーアイコン">
				</div>
				<div class="status_value goo_pos">
					<font>{{$coach['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="cho_icon">
					<img src="{{IMG_URL}}battle/hand2.png" alt="チョキアイコン">
				</div>
				<div class="status_value cho_pos">
					<font>{{$coach['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="paa_icon">
					<img src="{{IMG_URL}}battle/hand3.png" alt="チョキアイコン">
				</div>
				<div class="status_value paa_pos">
					<font>{{$coach['paaAtk']}}</font>
				</div>

				{{--キャラ名--}}
				<font class="chara_name">{{$coach['name']}}</font>
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