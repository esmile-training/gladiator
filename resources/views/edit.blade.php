@include('common/js', ['file' => 'edit'])
@include('common/css', ['file' => 'edit'])
<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
<div>				
	<img class = "edit_load backload"src = "{{IMG_URL}}title/titlelodoDown.gif">
</div>
<div class = "editload">
<div id="main">
<div align="center">
	<div class="edit_frame_img">
		<h1 class="edit_title">チーム名を入力してください</h1>
		<img class="edit_frame_width" src="{{IMG_URL}}edit/overFrame" />
		<img class="edit_frame_width" style="height: 50%;" src="{{IMG_URL}}edit/centerFrame" />
		<img class="edit_frame_width" src="{{IMG_URL}}edit/underFrame" />
	</div>

	<font color="red">※全角８文字以内</font>
	<form class="edit_from" name="form1" action="{{APP_URL}}edit/addUser" method="get">
<!--		<input class="edit_input" type="text" name="teamName" onkeydown="charCheck()" onkeyup="charCheck()" onchange="wupBtn()">-->
		<input class="edit_input" type="text" ng-model="zenkaku" ng-change="chkZenkaku(zenkaku)"/>
		<input class="edit_submit load" type="button" value="登録" onclick="disbtn(this)" disabled>
		<input type="hidden" name="gachavalue" value="12">
	</form>
</div>
</div>
</div>
