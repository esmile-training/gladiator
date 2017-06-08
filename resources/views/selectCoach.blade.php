@include('common/css', ['file' => 'confirmChangeCoach'])
@include('common/css', ['file' => 'coachRetirement'])
<?php $count = 0; ?>
<div class="coach_all">
	<div class="coach_signboardinfo">
		<img src="{{IMG_URL}}/training/signboard_info.png">
		<div class ="coach_signboard_text">
			<font class = "coach_font">{{'コーチを選んでください。'}}</font>
		</div>
	</div>
	<div class="coach_signboard">
		 <img src="{{IMG_URL}}/status/selectCoachSign.png">
	</div>
	<div class = "coach_maxfont">
		<center>
		<font color="white">
		コーチ枠がいっぱいです。<br>
		交代させるコーチか、
		引退を選んでください。<br>
		</font>
		<font color="red">※選択したコーチは引退となります。</font>
		</center>
	</div>
{{--訓練中--}}
	@foreach($viewData['coachList'] as $coach)
	<div class="coach_allwindow">
	{{--ここまで変更--}}
	@if($coach['state'] == 1)
		<img src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
		<div class="coach_name training_font_serif">
			<font>{{$coach['name']}}</font>
		</div>
		<div class="icon_coach">
			<img src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
			{{--レアリティの表示--}}
			<img class="coach_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
			<img class="coach_rerity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
		</div>
	@else
{{--待機中--}}
	{{-- popupボタン --}}
	<div class="modal_btn confirmChangeCoach{{$count}}">
		
		<img src="{{IMG_URL}}/training/coachButton{{$coach['rare']}}.png">
		<div class="coachSelect_text coach_name">
			<font>{{$coach['name']}}</font>
		</div>
		<div class="icon_coach">
			<img src="{{IMG_URL}}/chara/icon/icon_{{$coach['imgId']}}.png">
			{{--レアリティの表示--}}
			<img class="coach_reritybg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
			<img class="coach_rerity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
		</div>
		<div class="coach_goo">
			{{$coach['gooAtk']}}
		</div>
		<div class="coach_cho">
			{{$coach['choAtk']}}
		</div>
		<div class="coach_paa">
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
	<div class="coach_button_box">
	<a onclick="history.back()">
		<img class="image_change coach_button_back" src="{{IMG_URL}}popup/back_Button.png" alt="戻る">
	</a>
	<a href="{{APP_URL}}selectCoach/deleteChara?id={{$_GET['id']}}">
	<img class="image_change coach_button_retire" src="{{IMG_URL}}popup/retire_Button.png" alt="引退">
	</a>
</div>
</div>
