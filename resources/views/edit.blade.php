@include('common/js', ['file' => 'edit'])
@include('common/css', ['file' => 'edit'])

<div id="main">
<div align="center">
	<div class="edit_frame_img">
		<h1 class="edit_title">チーム名を入力してください</h1>
		<img class="edit_frame_width" src="http://esmile-sys.sakura.ne.jp/gladiator/img/edit/overFrame" />
		<img class="edit_frame_width" style="height: 50%;" src="http://esmile-sys.sakura.ne.jp/gladiator/img/edit/centerFrame" />
		<img class="edit_frame_width" src="http://esmile-sys.sakura.ne.jp/gladiator/img/edit/underFrame" />
	</div>

	<font color="red">※全角８文字以内</font>
	<form class="edit_from" name="form1" action="addUser" method="get">
		<input class="edit_input" type="text" name="teamName" onkeydown="charCheck()" onkeyup="charCheck()" onchange="wupBtn()"></p>
		<input class="edit_submit" type="button" value="登録" onclick="disbtn(this)" disabled>
		<input type="hidden" name="gachavalue" value="12">
	</form>
</div>
</div>