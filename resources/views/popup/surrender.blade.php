降参しますか？

@include('common/js', ['file' => 'gachapopup'])
<div>
	<a name="gacha">
		<img class="gacha_popup" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/popupbutton.png" name="yes" value="はい" onclick="yesno(gachaId = {{$gachaId}})">
		<p class = "gacha_popupfont">はい</p>
	</a>
	<a class="location modal_btn" href="{{APP_URL}}battle/makeResultData" >
		<img class="image_change　modal_btn" src="{{IMG_URL}}battle/surrender.png">
	</a>
</div>