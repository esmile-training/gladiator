@include('common/css', ['file' => 'gachaRoad'])
<?php
	foreach($viewData as $key => $value){
		$dataList[] = $key.'='.$value;
	}
	$dataStr = implode('&', $dataList);
?>
<div>
	<img class = "gacha_roadimg"src="{{IMG_URL_GACHA}}gacharoadbackground.png">
	<img class = "gacha_roadlogo"src="{{IMG_URL_GACHA}}gacharoadlogo.png">
	<a href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" class = "gacha_roadbutton">
	</a>
</div>

