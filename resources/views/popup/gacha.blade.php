スカウトしますか？

{{-- js --}}
@include('common/js', ['file' => 'gachapopup'])
<form name="gacha">
<div>
<input type="button" name="yes" value="はい" onclick="yesno(gachaId = {{$gachaId}});">
</div>
</form>
