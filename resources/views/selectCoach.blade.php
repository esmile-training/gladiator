@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/css', ['file' => 'confirmChangeCoach'])
<div class="chara_list">
<div>
	<img class='signboard_img' src='{{IMG_URL}}status/selectCoachSign.png' alt='コーチ選択'>
</div>
<br><br>
<div>
	<font color="white">
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
			{{--ボタンの表示間隔--}}
		<div class="button_margin">
			{{--ボタンの枠--}}
			<div class="modal_btn confirmChangeCoach{{ $count }} chara_button" style='left: 2%'>
				<input type='image' class="chara_button_frame_img" src='{{IMG_URL}}training/coachButton.png'>
			{{--キャラアイコン--}}
			<div class="chara_icon">
				{{--キャライメージ--}}
				<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$coach['imgId']}}.png" alt="キャラアイコン">
				{{--レアリティの表示--}}
				<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
				<img class="rarity" src="{{IMG_URL}}gacha/{{$coach['rare']}}.png" alt="レアリティ">
			</div>
			{{--ステータスの表示--}}
				<div class="chara_status">
					{{--名前の表示--}}
					<font class="chara_name font_serif">{{$coach['name']}}</font>
					{{--hpの表示--}}
					<font class="hp_value font_sentury">{{$coach['hp']}}</font>
					{{--手の表示--}}
					<font class="goo_value font_sentury">{{$coach['gooAtk']}}</font>
					<font class="cho_value font_sentury">{{$coach['choAtk']}}</font>
					<font class="paa_value font_sentury">{{$coach['paaAtk']}}</font>
				</div>
			</div>
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
		<img class="image_change" src="{{IMG_URL}}popup/back_Button.png" alt="戻る">
	</a>
	<a class='button retire' href="{{APP_URL}}selectCoach/deleteChara?id={{$_GET['id']}}">
		<img class="image_change" src="{{IMG_URL}}popup/retire_Button.png" alt="引退">
	</a>
</div>
</div>