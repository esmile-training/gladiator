{{-- css  --}}
<div Align="center">
	キャラクター一覧
</div>
<div Align="right">
<form  action="listSort" method="get">
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
	<input type="radio" name="order" value="3" checked="checked">降順
	<input type="radio" name="order" value="4">昇順
	<input type="submit" value="決定">
</form>
</div>
{{--所持キャラクターをすべて表示する--}}
<?php if(is_null($viewData['charaList'])){ 
	 echo '<div>'.'キャラクターがいません。','<div>';
	} else {
	$count = 1; ?>
	<div>
		@foreach($viewData['charaList'] as $chara)
			{{-- popupボタン --}}
			<div class="modal_container">
				<br><?php if($chara['trainingState'] == 1) echo	 '訓練中'; ?>
				<input type='image' class="modal_btn charastatus{{ $count }}" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png" width="75" height="100">{{$chara['name']}}
			</div>
			{{-- popupウインドウ --}}
			<div class="modal charastatus{{ $count }}">
				@include('popup/charastatus')
				<div class="modal_frame">
					<div class="close">
						<span>close</span>
					</div>
				</div>
			</div>
			<?php $count++; ?>
		@endforeach
<?php } ?>	
	</div>
