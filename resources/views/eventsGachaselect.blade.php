@include('common/css', ['file' => 'gachaselect'])
<div>
<img class="kanban" src="{{IMG_URL_TEST}}kanban.png">
</div>
{{-- popoupボタン --}}
<div class="modal_container">
	<?php $w = date("w",strtotime($viewData['nowTime'])); (int)$w +=5; ?>
	<?php if(date('Y-m-d',strtotime($viewData['createTime'])) < date('Y-m-d',strtotime($viewData['nowTime']))): ?>
	<input type="image" class="modal_btn gacha4" src="{{IMG_URL_TEST}}gachabutton4.png" name = 'gachavalue' value = "4" width= 100% height= 100%>
	<?php endif; ?>
	<input type="image" class="modal_btn gacha{{$w}}" src="{{IMG_URL_TEST}}gachabutton{{$w}}.png" name = 'gachavalue' value = "{{$w}}"width= 100% height= 100%>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton5.png" width= 100% height= 100%>
</div>
<a href="{{APP_URL}}gacha/select"><img src="{{IMG_URL_TEST}}gachawaku.png"width = 50%><p class="text2">通常</p></a>
{{-- popupウインドウ --}}
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