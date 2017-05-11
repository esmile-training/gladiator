<div>
	<a href="{{APP_URL}}gacha/select">	通常　</a>	<a href="{{APP_URL}}gacha/eventsSelect">	イベント　</a>
</div>
{{-- popupボタン --}}
<div class="modal_container">

	<input type="image" class="modal_btn gacha1" src="{{IMG_URL_TEST}}gachabutton1.png" name = 'gachavalue' value = "1" width= 100% height= 100%>
	<input type="image" class="modal_btn gacha2" src="{{IMG_URL_TEST}}gachabutton2.png" name = 'gachavalue' value = "2"width= 100% height= 100%>
	<input type="image" class="modal_btn gacha3" src="{{IMG_URL_TEST}}gachabutton3.png" name = 'gachavalue' value = "3"width= 100% height= 100%>

</div>
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