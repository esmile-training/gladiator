@include('common/js', ['file' => 'edit'])
@include('common/css', ['file' => 'edit'])
@include('common/css', ['file' => 'modal'])
<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
<div>				
	<img class = "edit_load backload"src = "{{IMG_URL}}title/titlelodoDown.gif">
</div>
<div class = "editload">
<div id="main">
<div align="center">

	<div class="edit_frame">
		<h1 class="edit_title">名前入力</h1>
		<h4 class="edit_subtitle">※全角８文字以内</h4>
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popuptop.png" />
		<img class="edit_frame_img" style="height: 20%;" src="{{IMG_URL}}popup/popupmiddle.png" />
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popupbottom.png" />
	</div>
	
	<form class="edit_from" name="form1" action="{{APP_URL}}edit/addUser" method="get">
		<input class="edit_input" type="text" name="teamName" onkeydown="charCheck()" onkeyup="charCheck()" onchange="wupBtn()">
		<input class="edit_submit load" type="button" value="登録" onclick="disbtn(this)" disabled>
		<input type="hidden" name="gachavalue" value="12">
	</form>
		@include('popup/wrap', [
			'class'		=> 'helpButton',
			'template'	=> 'a'
	])
	<a>
		<input type="image" class="modal_btn helpButton" src="{{IMG_URL}}battle/help.png">
	</a>

</div>
</div>
</div>
