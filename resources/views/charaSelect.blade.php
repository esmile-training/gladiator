{{-- css  --}}
@include('common/css', ['file' => 'charaSelect'])
@include('common/css', ['file' => 'battleCharaSelect'])

<img class='status_sign' src='{{IMG_URL}}status/statusSign.png' alt='ステータス'>
<br>
<div Align="right">
	<form  action="{{APP_URL}}charaSelect/index" method="get">
		<select name="type">
		  <option value="id">ソート順を選択
		  </option>
		  <option value="hp">体力順</option>
		  <option value="name">名前順</option>
		  <option value="rare">レア度順</option>
		  <option value="attribute">属性順</option>
		  <option value="gooAtk">グー順</option>
		  <option value="choAtk">チョキ順</option>
		  <option value="paaAtk">パー順</option>
		</select>
		<input type="radio" name="order" value="DESC" checked="checked"><font color='silver'>降順<font>
		<input type="radio" name="order" value="ASC"><font color='silver'>昇順<font>
		<input type="submit" value="決定">
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