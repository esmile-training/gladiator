@include('common/css', ['file' => 'gachaRoad'])
<?php
	foreach($viewData as $key => $value){
		$dataList[] = $key.'='.$value;
	}
	$dataStr = implode('&', $dataList);
?>
<div style = "position:absolute">
	<img class = "gacha_roadlogo"src="{{IMG_URL_GACHA}}gacharoadlogo.png">
	<a href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" class = "gacha_roadbutton">
	</a>
</div>

