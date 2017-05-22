@include('common/css', ['file' => 'gachaRoad'])
<?php
	foreach($viewData as $key => $value){
		$dataList[] = $key.'='.$value;
	}
	$dataStr = implode('&', $dataList);
?>

<div style = "position:absolute">]
	<div>
		<img class = "anim" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/anim1.png">
	</div>
	<a href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" class = "gacha_roadbutton">
	</a>
</div>

