@include('common/css', ['file' => 'confirmChangeCoach'])
@include('common/css', ['file' => 'coachSelect'])
@include('common/css', ['file' => 'training'])
<?php $count = 0; ?>
<div class="coachSelect_all">
	<div class="training_signboard_info">
		<img src="{{IMG_URL}}/status/selectCoachSign.png">
		<div class ="training_signboard_text">
			<font  class="training_text">{{'コーチを選んでください。'}}</font>
		</div>
	</div>
	<div class="coachSelect_signboard">
		 <img src="{{IMG_URL}}/training/signboard.png">
	</div>
		<center>
		<font color="white">
		コーチ枠がいっぱいです。<br>
		交代させるコーチか、
		引退を選んでください。<br>
		</font>
		<font color="red">※選択したコーチは引退となります。</font>
		</center>
{{--訓練中--}}
	@foreach($viewData['coachList'] as $coach)
	<div class="training_coach_window" style="margin-top: 1%">
	@if($coach['state'] == 1)
		<img src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
		<div class="coachSelect_text training_coach_name">
			<font>{{$coach['name']}}</font>
		</div>
		<div class="training_coach_icon">
			<img src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
			{{--レアリティの表示--}}
			<img class="coachSelect_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
			<img class="coachSelect_rerity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
		</div>

	@else
{{--待機中--}}
	{{-- popupボタン --}}
	<div class="modal_btn confirmChangeCoach{{$count}}">
		
		<img src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
		<div class="coachSelect_text training_coach_name">
			<font>{{$coach['name']}}</font>
		</div>
		<div class="training_coach_icon">
			<img src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
			{{--レアリティの表示--}}
			<img class="coachSelect_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
			<img class="coachSelect_rerity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
		</div>
		<div class="coachSelect_text training_coach_goo_atk">
			{{$coach['gooAtk']}}
		</div>
		<div class="coachSelect_text training_coach_cho_atk">
			{{$coach['choAtk']}}
		</div>
		<div class="coachSelect_text training_coach_paa_atk">
			{{$coach['paaAtk']}}
		</div>
	</div>

	{{-- popupウインドウ --}}
	@include('popup/wrap', [
	'class' => "confirmChangeCoach{$count}",
	'template' => 'confirmChangeCoach'
	])
	<?php $count++; ?>
	@endif
</div>
	@endforeach
	<div class="button_box">
	<a class='button back' onclick="history.back()">
	<img class="image_change" src="{{IMG_URL}}popup/back_Button.png" alt="戻る">
	</a>
	<a class='button retire' href="{{APP_URL}}selectCoach/deleteChara?id={{$_GET['id']}}">
	<img class="image_change" src="{{IMG_URL}}popup/retire_Button.png" alt="引退">
	</a>
</div>
</div>
