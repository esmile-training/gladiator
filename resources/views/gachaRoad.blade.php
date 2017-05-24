@include('common/css', ['file' => 'gachaRoad'])
<?php
	foreach($viewData['gacha'] as $key => $value){
		$dataList[] = $key.'='.$value;
	}
	$dataStr = implode('&', $dataList);
?>
<div style = "position:absolute">
	
	<div class = "album">
		<img class = "img1" src="http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/anim1.png">
		<img class = "img2" src="http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/anim2.png">
		<img class = "img3" src="http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/anim3.png">
		<img class = "img4" src="http://esmile-sys.sakura.ne.jp/gladiator/img/gacha/anim4.png">
	</div>
	<a href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" class = "gacha_roadbutton">
	</a>
</div>

