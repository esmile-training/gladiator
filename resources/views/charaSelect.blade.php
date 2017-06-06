{{-- css  --}}
@include('common/css', ['file' => 'charaSelect'])
@include('common/css', ['file' => 'battleCharaSelect'])
@include('common/js',['file' => 'sort'])

<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$order = isset($_GET['order']) ? $_GET['order'] : '';
?>

<div id="roadCover" class="offCover">
	<div>
		<p>「<?php $order == 'DESC' ? print '降順' : print '昇順'; ?>」<br>「<div class="getType(<?php $type ?>)">aaa</div>」<br>の条件で並べかえています。</p>
	</div>
</div>
	
<div class="chara_list">
	<img class='signboard_img' src='{{IMG_URL}}status/statusSign.png' alt='ステータス'>
	{{--所持キャラクターをすべて表示する--}}
@if(is_null($viewData['charaList']))
	<div><p style="color: white">キャラクターがいません。</p></div>
@else
	<div class="sort_Box">
		<form action="{{APP_URL}}charaSelect/index" method="get">
			<ul>
				<li>
					<input type="radio" name="order" value="DESC" <?php $order == 'DESC' ? print 'class="act" checked' : ''; ?> onchange="submit(this.form),onSortChange()">
					<label>昇順</label>
				</li>
				<li>
					<input type="radio" name="order" value="ASC" <?php $order == 'ASC' ? print 'class="act" checked' : ''; ?> onchange="submit(this.form),onSortChange()">
					<label>降順</label>
				</li>
			</ul>
			<select name="type" onchange="submit(this.form),onSortChange()">
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
	<?php $count = 0; ?>
	@foreach($viewData['charaList'] as $chara)
		{{-- popupボタン --}}
		{{--ボタンの表示間隔--}}
		<div class="button_margin">
		{{--キャラボタン--}}
		<div class="modal_btn charaStatus{{ $count }} chara_button" style='left: 2%'>
			<input type='image' class="chara_button_frame_img" src='{{IMG_URL}}battle/chara_button_frame{{$chara['rare']}}.png'>
			{{--キャラアイコン--}}
			<div class="chara_icon">
				{{--キャラアイコン--}}
				<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">
				{{--レアリティの表示--}}
				<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
				<img class="rarity" src="{{IMG_URL}}gacha/{{$chara['rare']}}.png" alt="レアリティ">
			</div>
			{{--ステータスの表示--}}
			<div class="chara_status">
				{{--名前の表示--}}
				<font class="chara_name font_serif white">{{$chara['name']}}</font>
				{{--hpの表示--}}
				<font class="hp_value font_color_green font_sentury white">{{$chara['hp']}}</font>
				{{--手の表示--}}
				<font class="goo_value font_sentury white">{{$chara['gooAtk']}}</font>
				<font class="cho_value font_sentury white">{{$chara['choAtk']}}</font>
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
