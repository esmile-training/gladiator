{{-- css  --}}
@include('common/css', ['file' => 'charaSelect'])

<div Align="center">
	<font color="silver">キャラクター一覧</font>
</div>
<div Align="right">
<form  action="{{APP_URL}}selectChara/index" method="get">
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
	<div>キャラクターがいません。<div>
@else
	<?php $count = 1 ?>
	@foreach($viewData['charaList'] as $chara)
		{{-- popupボタン --}}
		<div class="modal_container">
		<br>
		@if($chara['trainingState'] == 1)
			訓練中
		@endif
		<input type='image' class="modal_btn charastatus{{ $count }}" src="{{IMG_URL_CHARA}}/icon/icon_{{$chara['imgId']}}.png" width="100">{{$chara['name']}}
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