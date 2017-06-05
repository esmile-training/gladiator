{{-- css  --}}
@include('common/css', ['file' => 'charaSelect'])
@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/js',['file' => 'sort'])

<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$order = isset($_GET['order']) ? $_GET['order'] : '';
?>
<div class="chara_list">
	<img class='signboard_img' src='{{IMG_URL}}status/statusSign.png' alt='ステータス'>
	<div class="sort_Box">
		<form action="{{APP_URL}}charaSelect/index" method="get">
			<input type="radio" name="order" value="DESC" checked="checked">降順
			<input type="radio" name="order" value="ASC">昇順
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
		{{--ボタンの表示間隔--}}
		<div class="button_margin">
		{{--キャラボタン--}}
		<div class="modal_btn charaStatus{{ $count }} chara_button" style='left: 2%'>
			<input type='image' class="chara_button_frame_img" src='{{IMG_URL}}battle/chara_button_frame.png'>
			{{--キャラアイコン--}}
			<div class="chara_icon">
				{{--キャラアイコンのフレーム--}}
				<div class="icon_frame_margin">
					<img class="icon_frame" src="{{IMG_URL}}battle/icon_frame{{$chara['iconFrame']}}.png" alt="キャラアイコンの枠">
				</div>
				{{--キャラアイコン--}}
				<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">
				{{--レアリティの表示--}}
				<img class="rarity_bg" src="{{IMG_URL}}gacha/logoflash.png" alt="レアリティの背景">
				<img class="rarity" src="{{IMG_URL}}gacha/{{$chara['rare']}}.png" alt="レアリティ">
			</div>
			{{--ステータスの表示--}}
			<div class="chara_status">
				{{--名前の表示--}}
				<font class="chara_name font_serif white">{{$chara['name']}}</font>
				{{--hpの表示--}}
				<img class="hp_icon" src="{{IMG_URL}}chara/status/hp.png" alt="HPアイコン">
				<font class="hp_value font_color_green font_sentury white">{{$chara['hp']}}</font>
				{{--手の表示--}}
				<img class="goo_icon" src="{{IMG_URL}}chara/status/hand1.png" alt="グーアイコン">
				<font class="goo_value font_sentury white">{{$chara['gooAtk']}}</font>
				<img class="cho_icon" src="{{IMG_URL}}chara/status/hand2.png" alt="チョキアイコン">
				<font class="cho_value font_sentury white">{{$chara['choAtk']}}</font>
				<img class="paa_icon" src="{{IMG_URL}}chara/status/hand3.png" alt="パーアイコン">
				<font class="paa_value font_sentury white">{{$chara['paaAtk']}}</font>
			</div>
		</div>
	</div>
{{-- popupウインドウ --}}
<div class="modal charaStatus{{$count}}">
	<div>
		<div>
			<img class="modal_frametop"src="{{SERVER_URL}}img/popup/popuptop.png">
			<div>
				@include('popup/charaStatus')
			</div>
			<div class="close">
				<img src="{{SERVER_URL}}img/popup/closebutton.png">
				<span>close</span>
			</div>
		</div>
		<div>
			<img class="modal_framemiddle"src="{{SERVER_URL}}img/popup/popupmiddle.png">
		</div>
		<div>
			<img class="modal_framebottom"src="{{SERVER_URL}}img/popup/popupbottom.png">
		</div>
	</div>
</div>
	<?php $count++ ?>
	@endforeach
@endif
</div>
