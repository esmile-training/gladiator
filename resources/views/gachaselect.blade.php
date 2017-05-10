<div>
	<form action="{{APP_URL}}gacha/viewDataSet" method="get">
	<input type="image" src="{{IMG_URL_TEST}}gachabutton1.png" name = 'gachavalue' value = "1" width= 100% height= 100%>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton2.png" name = 'gachavalue' value = "2"width= 100% height= 100%>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton3.png" name = 'gachavalue' value = "3"width= 100% height= 100%>
	</span>
	<a href="{{APP_URL}}gacha/select">	通常　</a>	<a href="{{APP_URL}}gacha/eventsSelect">	イベント　</a>
</div>
</form>
	
{{-- popupボタン --}}
<div class="modal_container">
    <span class="modal_btn gacha">Show modal</span>
</div>
	
{{-- popupウインドウ --}}
@include('popup/wrap', ['template' => 'gacha'])




