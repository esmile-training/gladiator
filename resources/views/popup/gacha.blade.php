スカウトしますか？

{{-- js --}}
@include('common/js', ['file' => 'gachapopup'])
<div>
	<a name="gacha">
		<img class="gacha_popup" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/popupbutton.png" name="yes" value="はい" onclick="yesno(gachaId = {{$gachaId}})">
		<p class = "gacha_popupfont">はい</p>
	</a>
</div>