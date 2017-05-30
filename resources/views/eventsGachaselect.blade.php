@include('common/css', ['file' => 'gachaselect'])
<div class = "gacha_all">
	<div>
		<img class="gacha_signboard" 
			 src="{{IMG_URL}}gacha/kanban.png">
	</div>
	<div class = "junban0">
		<img class="gacha_frame" 
			 src="{{IMG_URL}}gacha/wakuevent.png">
		<a href="{{APP_URL}}gacha/select">
			<input type="submit" class = "normalbutton">
		</a>
	</div>
	{{-- popoupボタン --}}
	<div class = "junban1">
		<div class="modal_container">
			<?php $w = date("w",strtotime($viewData['nowTime'])); (int)$w +=5; ?>
			@if(date('Y-m-d',strtotime($viewData['createTime'])) < date('Y-m-d',strtotime($viewData['nowTime'])))
			<div class = "gacha_button1">
				<input type="image" 
					   class="modal_btn gacha4" 
					   src="{{IMG_URL}}gacha/banner4.png" name = 'gachavalue' 
					   value = "4" 
					   width= 100% 
					   height= 100%>
			</div>
			@else
			<input type="image" 
				   class = "gacha_button1" 
				   src="{{IMG_URL}}gacha/banner13.png" 
				   width= 100% 
				   height= 100%>
			@endif
			<div class = "gacha_button2">
				<input type="image" 
					   class="modal_btn gacha{{$w}}" 
					   src="{{IMG_URL}}gacha/banner{{$w}}.png" 
					   name = 'gachavalue' value = "{{$w}}"
					   width= 100% 
					   height= 100%>
			</div>
			<div class = "gacha_button3">
				<input type="image" 
					   src="{{IMG_URL}}gacha/banner5.png" 
					   width= 100% 
					   height= 100%>
			</div>
		</div>
	</div>
</div>
{{-- popupウインドウ --}}
@include('popup/wrap', [
	'class'		=> 'gacha4', 
	'template'	=> 'gacha',
	'data'		=> ['gachaId' => 4]
])
@include('popup/wrap', [
	'class'		=> "gacha{$w}",
	'template'	=> 'gacha',
	'data'		=> ['gachaId' => $w]
])