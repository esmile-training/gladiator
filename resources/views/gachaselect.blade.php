@include('common/css', ['file' => 'gachaselect'])
<div class = "all">
	<div>
		<img class="kanban" src="{{IMG_URL_GACHA}}kanban.png">
	</div>
	<div class = "junban0">
		<img class="waku" src="{{IMG_URL_GACHA}}wakunormal.png">
	</div>
	{{-- popupボタン --}}
	<div class = "junban1">
		<div class="modal_container">
			<div class = "button1">
				<input type="image" class="modal_btn gacha1" src="{{IMG_URL_GACHA}}gachabutton1.png" name = 'gachavalue' value = "1" width= 100% height= 100%>
			</div>
			<div class = "button2">
				<input type="image" class="modal_btn gacha2" src="{{IMG_URL_GACHA}}gachabutton2.png" name = 'gachavalue' value = "2"width= 100% height= 100%>
			</div>
			<div class = "button3">
				<input type="image" class="modal_btn gacha3" src="{{IMG_URL_GACHA}}gachabutton3.png" name = 'gachavalue' value = "3"width= 100% height= 100%>
			</div>
		</div>
	</div>
</div>
<a href="{{APP_URL}}gacha/eventsSelect">
	<input type="submit" class = "eventebutton">
</a>
{{-- popupウインドウ --}}
<div class="modal gacha1">
	@include('popup/'.'gacha', ['gachaId' => 1])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>
<div class="modal gacha2">
	@include('popup/'.'gacha', ['gachaId' => 2])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>
<div class="modal gacha3">
	@include('popup/'.'gacha', ['gachaId' => 3])
	<div class="modal_frame">
		<div class="close">
			<span>close</span>
		</div>
	</div>
</div>