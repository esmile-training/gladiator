@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/css', ['file' => 'confirmChangeCoach'])
<div id='main'>
<div>
	<img class='select_coach_sign' src='{{IMG_URL}}status/selectCoachSign.png' alt='コーチ選択'>
</div>
<br><br>
<div>
	<font color="silver">
	<center>
	コーチ枠がいっぱいです。<br>
	交代させるコーチか、
	引退を選んでください。<br>
	</font>
	<font color="red">※選択したコーチは引退となります。</font>
	</center>
</div>
<?php $count = 0; ?>
<div class="coachselecter">
	@foreach($viewData['coachList'] as $coach)
		@if($coach['state'] == 1)	
			<div class="chara_frame" style='left: 2%'>
				<image src='{{IMG_URL}}training/coachButton.png'>

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png"	alt="キャラアイコン">
				</div>
				<div class="white status_value goo_pos">
					<font><i>訓練中</i></font>
				</div>
				{{--キャラ名--}}
				<font class="chara_name">{{$coach['name']}}</font>
			</div>
		@else
			{{-- popupボタン --}}
			{{--ボタンの枠--}}
			<div class="modal_btn confirmChangeCoach{{ $count }} chara_frame" style='left: 2%'>
				<input type='image' class="chara_frame_img" src='{{IMG_URL}}training/coachButton.png'>
				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png"
					alt="キャラアイコン">
				</div>
				{{--HP--}}
				<div class="hp_icon">
					<img src="{{IMG_URL}}chara/status/hp.png" alt="HPアイコン">
				</div>
				<div class="hp_value">
					<font>{{$coach['hp']}}</font>
				</div>
				{{--グー--}}
				<div class="goo_icon">
					<img src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
				</div>
				<div class="white status_value goo_pos">
					<font>{{$coach['gooAtk']}}</font>
				</div>

				{{--チョキ--}}
				<div class="cho_icon">
					<img src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
				</div>
				<div class="white status_value cho_pos">
					<font>{{$coach['choAtk']}}</font>
				</div>

				{{--パー--}}
				<div class="paa_icon">
					<img src="{{IMG_URL}}chara/status/hand3.png" alt="チョキアイコン">
				</div>
				<div class="white status_value paa_pos">
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
	<a class='button back' onclick="history.back()">
		<img class="image_change" src="{{SERVER_URL}}img/popup/back_Button.png" alt="戻る">
	</a>
	<a class='button retire' href="{{APP_URL}}selectCoach/deleteChara?id={{$_GET['id']}}">
		<img class="image_change" src="{{SERVER_URL}}img/popup/retire_Button.png" alt="引退">
	</a>
</div>
</div>