<div><img class="gacha_roadback" src="{{IMG_URL}}gacha/gacharoadbackground.jpg" /></div>
@include('common/css', ['file' => 'gachaRoad'])
@foreach($viewData['gacha'] as $key => $value)
	<?php $dataList[] = $key.'='.$value; ?>
@endforeach
<?php $dataStr = implode('&', $dataList);?>

<div style = "position:absolute">
	
	<div class = "album">
		<img class = "img1" 
			 src="{{IMG_URL}}gacha/anim1.png">
		<img class = "img2" 
			 src="{{IMG_URL}}gacha/anim2.png">
		<img class = "img3" 
			 src="{{IMG_URL}}gacha/anim3.png">
		<img class = "img4" 
			 src="{{IMG_URL}}gacha/anim4.png">
	</div>
	<a class = "gacha_roadbotton" href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" 
			   class = "gacha_roadbutton">
	</a>
</div>

