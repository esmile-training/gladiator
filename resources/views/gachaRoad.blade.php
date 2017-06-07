{{-- 背景 --}}
<div><img class="gacha_roadback" src="{{IMG_URL}}gacha/gacharoadbackground.jpg" /></div>

{{-- データー受け渡し --}}
@foreach($viewData['gacha'] as $key => $value)
	<?php $dataList[] = $key.'='.$value; ?>
@endforeach
<?php $dataStr = implode('&', $dataList);?>
{{-- キャラのアニメーション --}}
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
	{{-- ボタン --}}
	<a class = "gacha_roadbotton" href="{{APP_URL}}gacha/index?<?php echo $dataStr;?>">
		<input type="submit" 
			   class = "gacha_roadbutton">
	</a>
</div>
{{-- CSS読み込み --}}
@include('common/css', ['file' => 'gachaRoad'])
