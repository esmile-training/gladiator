@include('common/js', ['file' => 'edit'])

<div align="center">
	<br>エディット画面
</div>

<div align="center">

	<p>チーム名を入力してください<br>

	<font color="red">※全角８文字以内</font><br>
	<form name="form1" action="addUser" method="get">
		<input type="text" name="teamName" onkeydown="charCheck()" onkeyup="charCheck()" onchange="wupBtn()"></p>
		<input type="submit" value="登録" onclick="disbtn(this)" disabled>
	<input type="hidden" name="gachavalue" value="12">
	</form>
</div>
