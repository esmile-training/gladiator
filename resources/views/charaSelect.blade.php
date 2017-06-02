{{-- css  --}}
@include('common/css', ['file' => 'charaSelect'])
@include('common/css', ['file' => 'battleCharaSelect'])

<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$order = isset($_GET['order']) ? $_GET['order'] : '';
?>
<div id='main'>
<img class='status_sign' src='{{IMG_URL}}status/statusSign.png' alt='ステータス'>
<br>
<div Align="right">
	<form  action="{{APP_URL}}charaSelect/index" method="get">
		<input type="radio" name="order" value="DESC" checked="checked"><font color='silver' style="font-family: serif">降順<font>
		<input type="radio" name="order" value="ASC"><font color='silver' style="font-family: serif">昇順<font>
		<select name="type" onchange="submit(this.form)">
		  <option value="id"<?php $type == 'id' ? print 'selected' : ''; ?>>入手</option>
		  <option value="hp"<?php $type == 'hp' ? print 'selected' : ''; ?>>体力</option>
		  <option value="name"<?php $type == 'name' ? print 'selected' : ''; ?>>名前</option>
		  <option value="rare"<?php $type == 'rare' ? print 'selected' : ''; ?>>レア度</option>
		  <option value="gooAtk"<?php $type == 'gooAtk' ? print 'selected' : ''; ?>>グー 攻撃力</option>
		  <option value="choAtk"<?php $type == 'choAtk' ? print 'selected' : ''; ?>>チョキ 攻撃力</option>
		  <option value="paaAtk"<?php $type == 'paaAtk' ? print 'selected' : ''; ?>>パー 攻撃力</option>
		</select>
	</form>
</div>
{{--所持キャラクターをすべて表示する--}}
@if(is_null($viewData['charaList']))
	<div>キャラクターがいません。</div>
@else
	<?php $count = 0; ?>
	@foreach($viewData['charaList'] as $chara)
		{{-- popupボタン --}}
		{{--ボタンの枠--}}
		<div class="modal_btn charastatus{{ $count }} chara_frame" style='left: 2%'>
			<input type='image' class="chara_frame_img" src='{{IMG_URL}}battle/chara_button_frame.png'>
			{{--キャラアイコン--}}
			<div class="chara_icon">
				<img src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">
			</div>
			{{--HP--}}
			<div class="hp_icon">
				<img src="{{IMG_URL}}chara/status/hp.png" alt="HPアイコン">
			</div>
			<div class="hp_value">
				<font>{{$chara['hp']}}</font>
			</div>
			{{--グー--}}
			<div class="goo_icon">
				<img src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
			</div>
			<div class="white status_value goo_pos">
				<font>{{$chara['gooAtk']}}</font>
			</div>

			{{--チョキ--}}
			<div class="cho_icon">
				<img src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
			</div>
			<div class="white status_value cho_pos">
				<font>{{$chara['choAtk']}}</font>
			</div>

			{{--パー--}}
			<div class="paa_icon">
				<img src="{{IMG_URL}}chara/status/hand3.png" alt="チョキアイコン">
			</div>
			<div class="white status_value paa_pos">
				<font>{{$chara['paaAtk']}}</font>
			</div>

			{{--キャラ名--}}
			<font class="chara_name">{{$chara['name']}}</font>
		</div>
		{{-- popupウインドウ --}}
		@include('popup/wrap', [
		'class'	=> "charastatus{$count}",
		'template' => 'charastatus'
		])
	<?php $count++ ?>
	@endforeach
@endif
<?php $count ?>
</div>