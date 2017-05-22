@include('common/css', ['file' => 'gachaselect'])
<div class = "gacha_all">
	<div>
		<img class="gacha_signboard" src="{{IMG_URL_GACHA}}kanban.png">
	</div>
	<div class = "junban0">
		<img class="gacha_frame" src="{{IMG_URL_GACHA}}wakuevent.png">
		<a href="{{APP_URL}}gacha/select">
			<input type="submit" class = "normalbutton">
		</a>
	</div>
	{{-- popoupボタン --}}
	<div class = "junban1">
		<div class="modal_container">
			<?php $w = date("w",strtotime($viewData['nowTime'])); (int)$w +=5; ?>
			<?php if(date('Y-m-d',strtotime($viewData['createTime'])) < date('Y-m-d',strtotime($viewData['nowTime']))): ?>
			<div class = "gacha_button1">
				<input type="image" class="modal_btn gacha4" src="{{IMG_URL_GACHA}}gachabutton4.png" name = 'gachavalue' value = "4" width= 100% height= 100%>
			</div>
			<?php endif; ?>
			<div class = "gacha_button2">
				<input type="image" class="modal_btn gacha{{$w}}" src="{{IMG_URL_GACHA}}gachabutton{{$w}}.png" name = 'gachavalue' value = "{{$w}}"width= 100% height= 100%>
			</div>
			<div class = "gacha_button3">
				<input type="image" src="{{IMG_URL_GACHA}}gachabutton5.png" width= 100% height= 100%>
			</div>
		</div>
	</div>
</div>
{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> 'gacha1', 
	'template'	=> 'gacha',
	'data'		=> ['gachaId' => 4]
])
@include('popup/wrap', [
	'class'		=> 'gacha1', 
	'template'	=> 'gacha',
	'data'		=> ['gachaId' => $w]
])
<div class="modal gacha4">
	@include('popup/'.'gacha', ['gachaId' => 4])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>
<div class="modal gacha{{$w}}">
	@include('popup/'.'gacha', ['gachaId' => $w])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>
