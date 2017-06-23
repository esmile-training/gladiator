{{--/*
 * 戦闘のキャラ選択ビュー
 * 製作者：松井 勇樹
 * 最終更新日:2017/06/09
 */--}}

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
		<p>「<?php $order == 'DESC' ? print '降順' : print '昇順'; ?>」<br>「<?php echo 'ソート条件' ?>」<br>の条件で並べかえています。</p>
	</div>
</div>

{{--所持キャラクターをすべて表示する--}}
@if(!is_null($viewData['charaList']))
<div class="chara_list">
	@foreach($viewData['charaList'] as $chara)
	{{--ボタンの表示間隔--}}
		<div class="chara_button_margin">
			<a href="{{APP_URL}}battle/selectArena?uCharaId={{$chara['id']}}&imageId={{$chara['imgId']}}
				&rarity={{$chara['rare']}}&name={{$chara['name']}}&hp={{$chara['hp']}}
				&gooAtk={{$chara['gooAtk']}}&choAtk={{$chara['choAtk']}}&paaAtk={{$chara['paaAtk']}}">

				{{--キャラボタン--}}
				<div class="chara_button">
					<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$chara['rare']}}.png" alt="ボタンの下地">

					{{--キャラアイコン--}}
					<div class="chara_icon">

						{{--キャライメージ--}}
						<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$chara['imgId']}}.png" alt="キャラアイコン">

						{{--レアリティの表示--}}
						<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
						<img class="rarity" src="{{IMG_URL}}gacha/{{$chara['rare']}}.png" alt="レアリティ">
					</div>

					{{--ステータスの表示--}}
					<div class="chara_status">
						{{--名前の表示--}}
						<font class="chara_name font_serif">{{$chara['name']}}</font>
						{{--hpの表示--}}
						<font class="hp_value font_sentury">{{$chara['hp']}}</font>
						{{--手の表示--}}
						<font class="goo_value font_sentury">{{$chara['gooAtk']}}</font>
						<font class="cho_value font_sentury">{{$chara['choAtk']}}</font>
						<font class="paa_value font_sentury">{{$chara['paaAtk']}}</font>
					</div>

				</div>
			</a>
		</div>
	@endforeach
</div>
@else
<div class = "no_chara font_color font_serif">
	所属している剣闘士が０人です！
</div>
@endif
<div class="signboard_info">
	<img src="{{IMG_URL}}signboard/info.png">
	<font class="signboard_text font_color font_serif">出場させる剣闘士を選んでください</font>
</div>

{{--キャラクターの所持数を表示する--}}
<div class="chara_inventory">
	<img src="{{IMG_URL}}battle/inventory_bord.png">
	<font class="inventory_value font_color font_sentury">{{$viewData['charaInventory']['possession']}} / {{$viewData['charaInventory']['upperLimit']}}</font>

	{{--ソートの表示--}}
	<div class="sort_Box">
		<form action="{{APP_URL}}battle/index" method="get">
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
</div>

<img class="signboard" src="{{IMG_URL}}signboard/battle.png" alt="看板">
