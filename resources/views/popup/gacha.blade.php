スカウトしますか？

{{-- js --}}
@include('common/js', ['file' => 'gachapopup'])
<div>
	<a name="gacha">
		<img class="gacha_popup" src = "http://esmile-sys.sakura.ne.jp/gladiator/img/popup/yes_Button.png" name="yes" value="はい" onclick="yesno(gachaId = {{$gachaId}})">
	</a>
</div>