{{-- css  --}}
<div Align="center">
	<font color="silver">キャラクター一覧</font>
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
	<input type="radio" name="order" value="3" checked="checked"><font color='silver'>降順<font>
	<input type="radio" name="order" value="4"><font color='silver'>昇順<font>
	<input type="submit" value="決定">
</form>
</div>
{{--所持キャラクターをすべて表示する--}}
<?php if(is_null($viewData['charaList'])){ 
	echo '<div>'.'キャラクターがいません。','<div>';
	} else {
	$count = 1; ?>
	@foreach($viewData['charaList'] as $chara)
	{{-- popupボタン --}}
	<div class="modal_container">
		<br><?php if($chara['trainingState'] == 1) echo	 '訓練中'; ?>
		<input type='image' class="modal_btn charastatus{{ $count }}" src="{{IMG_URL_CHARA}}{{$chara['imgId']}}.png" width="75" height="100">{{$chara['name']}}
	</div>
	{{-- popupウインドウ --}}
	<div class="modal charastatus{{ $count }}">
		<!--@include('popup/charastatus')-->
        <div class="modal_top">
			<img class="modal_frametop"src="{{SERVER_URL}}img/popup/popuptop.png">
			<div class="close">
				<img class="modal_closebutton"src="{{SERVER_URL}}img/popup/closebutton.png">
                <span>close</span>
            </div>
        </div>
		<div class="modal_middle">
			<img class="modal_framemiddle"src="{{SERVER_URL}}img/popup/popupmiddle.png">
			<div class='modal_window'>
				@include('popup/charastatus')
			</div>
		</div>
		<div class="modal_bottom">
			<img class="modal_framebottom"src="{{SERVER_URL}}img/popup/popupbottom.png">
		</div>
	</div>
<?php $count++; ?>
	@endforeach
<?php } ?>	
