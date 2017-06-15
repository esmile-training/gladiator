<div><img class="training_back" src="{{IMG_URL}}gacha/gachabackground.jpg" /></div>
{{--CSS--}}
@include('common/css', ['file' => 'training'])
@include('common/css', ['file' => 'charaList'])
@include('common/js',['file' => 'sort'])

<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$order = isset($_GET['order']) ? $_GET['order'] : '';
?>

{{--訓練が終了しているキャラがいたらポップアップ表示--}}
<script>
	 var popup = Boolean(<?php echo $viewData['isTrainingEndFlag'] ?>);
	 $(function (){
		 if(popup)
		 {
			$('.trainingResult').css('display','block');
		 }
		 else
		 {
			 $('.trainingResult').css('display','none');
		 }
	 });
</script>

@if($viewData['isTrainingEndFlag'])
	<div class="modal trainingResult">
		{{--ポップアップウィンドウ--}}
		@include('popup/wrap', [
			'class'		=> "trainingResult",
			'template'	=> 'training',
		])
	</div>
@endif

<div class="signboard_info">
	<img src="{{IMG_URL}}/training/signboard_info.png">
	<font  class="signboard_text font_serif font_color">{{'訓練する剣闘士を選んでください'}}</font>
</div>
{{--キャラクターの所持数を表示する--}}
<div class="chara_inventory">
	<img src="{{IMG_URL}}/battle/inventory_bord.png">
	<font class="inventory_text font_color font_serif">所属人数</font>
	<font class="inventory_value font_color font_sentury">{{$viewData['charaInventory']['possession']}}/{{$viewData['charaInventory']['upperLimit']}}</font>

</div>
<div class="signboard">
	<img src="{{IMG_URL}}/training/signboard.png">
</div>

{{--uChara(DB)から持ってきたデータの表示--}}
<div class="chara_list">
	@foreach( $viewData['charaList'] as $key => $val)
	<div class="chara_button_margin ">
		{{--ボタンの枠--}}
		<div class="chara_button">
			{{--訓練中ならグレースケール貼る--}}
			@if($val['trainingState'] == 1)
			<a class="training_a_none" href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
				<div class="scale_img"><img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠"></div>
			@else
			<a href="{{APP_URL}}training/coachSelect?uCharaId={{$val['id']}}">
			@endif
				<img class="chara_button_frame_img" src="{{IMG_URL}}battle/chara_button_frame{{$val['rare']}}.png" alt="ボタンの枠">

				{{--キャラアイコン--}}
				<div class="chara_icon">
					<img class="chara_image" src="{{IMG_URL}}chara/icon/icon_{{$val['imgId']}}.png" alt="キャラアイコン">
					{{--レアリティの表示--}}
					<img class="rarity_bg" src="{{IMG_URL}}battle/rarity_bg.png" alt="レアリティの背景">
					<img class="rarity" src="{{IMG_URL}}gacha/{{$val['rare']}}.png" alt="レアリティ">
				</div>

				{{--キャラクターのステータス表示--}}
				<div class="chara_status">
					{{--HP--}}
					<font class="hp_value font_sentury">{{$val['hp']}}</font>
					{{--グー--}}
					<font class="goo_value font_sentury">{{$val['gooAtk']}}</font>
					{{--チョキ--}}
					<font class="cho_value font_sentury">{{$val['choAtk']}}</font>
					{{--パー--}}
					<font class="paa_value font_sentury">{{$val['paaAtk']}}</font>
					{{--キャラ名--}}
					<font class="chara_name font_serif">{{$val['name']}}</font>
				</div>
			</a>
		</div>
	</div>
	@endforeach
	<div id="LoadCover" class="offCover">
		<div>
			<p>「<?php $order == 'DESC' ? print '降順' : print '昇順'; ?>」<br>「<?php echo 'ソート条件' ?>」<br>の条件で並べかえています。</p>
		</div>
	</div>
	<div class="sort_Box">
		<form action="{{APP_URL}}training/index" method="get">
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
