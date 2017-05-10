<div>
	<?php $w = date("w",strtotime($viewData['nowTime'])); (int)$w +=5; ?>
	<form action="{{APP_URL}}gacha/viewDataSet" method="get">
	<?php if(date('Y-m-d',strtotime($viewData['createTime'])) < date('Y-m-d',strtotime($viewData['nowTime']))): ?>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton4.png" name = 'gachavalue' value = "4" width= 100% height= 100%>
	<?php endif; ?>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton{{$w}}.png" name = 'gachavalue' value = "{{$w}}"width= 100% height= 100%>
	<input type="image" src="{{IMG_URL_TEST}}gachabutton5.png" name = 'gachavalue' value = "1"width= 100% height= 100%>
	<a href="{{APP_URL}}gacha/select">	通常　</a>	<a href="{{APP_URL}}gacha/eventsSelect">	イベント　</a>
</div>
</form>