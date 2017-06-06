@include('common/js', ['file' => 'edit'])
@include('common/css', ['file' => 'edit'])

<div id="main">
<div align="center">
	<div class="edit_frame">
		<h1 class="edit_title">名前入力</h1>
		<h4 class="edit_subtitle">※全角８文字以内</h4>
		<img class="edit_frame_img" src="{{SERVER_URL}}img/popup/popuptop.png" />
		<img class="edit_frame_img" style="height: 20%;" src="{{SERVER_URL}}img/popup/popupmiddle.png" />
		<img class="edit_frame_img" src="{{SERVER_URL}}img/popup/popupbottom.png" />
	</div>

	
	<form class="edit_from" name="form1" action="addUser" method="get">
		<input class="edit_input" type="text" name="teamName" onkeydown="charCheck()" onkeyup="charCheck()" onchange="wupBtn()"></p>
		<input class="edit_submit" type="button" value="登録" onclick="disbtn(this)" disabled>
		<input type="hidden" name="gachavalue" value="12">
	</form>
</div>
</div>
