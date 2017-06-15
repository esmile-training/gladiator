{{-- css  --}}
@include('common/css', ['file' => 'charaList'])
@include('common/js',['file' => 'sort'])
<div><img class="chara_list_background" src="{{IMG_URL}}battle/chara_select_bg.jpg" /></div>
<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$order = isset($_GET['order']) ? $_GET['order'] : '';
?>

<div id="loadCover" class="offCover">
	<div>
		<p>並べ変え中</p>
	</div>
</div>

	<div class="chara_list">
		<div class="signboard_info">
			<img src="{{IMG_URL}}/training/signboard_info.png">
			<font  class="signboard_text font_serif font_color">{{'剣闘士の詳細が見れます'}}</font>
		</div>
		{{--キャラクターの所持数を表示する--}}
		<div class="chara_inventory">
			<img src="{{IMG_URL}}/battle/inventory_bord.png">
			<font class="inventory_text font_color font_serif">所属人数</font>
			<font class="inventory_value font_color font_sentury">{{$viewData['charaInventory']['possession']}}/{{$viewData['charaInventory']['upperLimit']}}</font>

		</div>
		<div class="signboard">
			 <img src="{{IMG_URL}}/status/statusSign.png">
		</div>

	{{--所持キャラクターをすべて表示する--}}
@if(is_null($viewData['charaList']))
	<div><p style="color: white">キャラクターがいません。</p></div>
@else
	<?php $count = 0; ?>
	@foreach($viewData['charaList'] as $chara)
		{{-- popupボタン --}}
		{{--ボタンの表示間隔--}}
		<div class="chara_button_margin">
		{{--キャラボタン--}}
		<div class="modal_btn charaStatus{{ $count }} chara_button">
			<input type='image' class="chara_button_frame" src='{{IMG_URL}}battle/chara_button_frame{{$chara['rare']}}.png'>
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
				<font class="chara_name font_serif font_color">{{$chara['name']}}</font>
				{{--hpの表示--}}
				<font class="hp_value font_sentury font_color">{{$chara['hp']}}</font>
				{{--手の表示--}}
				<font class="goo_value font_sentury font_color">{{$chara['gooAtk']}}</font>
				<font class="cho_value font_sentury font_color">{{$chara['choAtk']}}</font>
				<font class="paa_value font_sentury font_color">{{$chara['paaAtk']}}</font>
			</div>
		</div>
	</div>
	{{-- popupウインドウ --}}
	<div class="modal charaStatus{{$count}}">
		<div>
			<div>
				<img class="modal_frametop"src="{{IMG_URL}}popup/popuptop.png">
				<div>
					@include('popup/charaStatus')
				</div>
				<div class="close">
					<img src="{{IMG_URL}}popup/closebutton.png">
					<span>close</span>
				</div>
			</div>
			<div>
				<img class="modal_framemiddle"src="{{IMG_URL}}popup/popupmiddle.png">
			</div>
			<div>
				<img class="modal_framebottom"src="{{IMG_URL}}popup/popupbottom.png">
			</div>
		</div>
	</div>
	<?php $count++ ?>
	<div class="sort_Box">
		<form action="{{APP_URL}}charaSelect/index" method="get">
			<ul>
				<li>
					<input type="radio" name="order" value="DESC" <?php $order == 'DESC' ? print 'class="act" checked' : ''; ?> onchange="submit(this.form),onSortChange(),getType()">
					<label>昇順</label>
				</li>
				<li>
					<input type="radio" name="order" value="ASC" <?php $order == 'ASC' ? print 'class="act" checked' : ''; ?> onchange="submit(this.form),onSortChange(),getType()">
					<label>降順</label>
				</li>
			</ul>
			<select name="type" onchange="submit(this.form),onSortChange(),getType()">
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
	@endforeach
@endif
</div>
