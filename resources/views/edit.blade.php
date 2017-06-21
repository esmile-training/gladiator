@include('common/js',['file' => 'edit'])
@include('common/css', ['file' => 'edit'])
@include('common/css', ['file' => 'modal'])
<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
<div><img class = "edit_logo editload" src = "{{IMG_URL}}edit/editLogo.png"></div>
	<img class = "edit_load backload"src = "{{IMG_URL}}title/titlelodoDown.gif">
</div>
<div class = "editload">
<div id="main">
<div align="center">

	<div class="edit_frame">
		<h1 class="edit_title">名前入力</h1>
		<h4 class="edit_subtitle">※全角８文字以内</h4>
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popuptop.png" />
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popupmiddle.png" />
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popupbottom.png" />
		<div class="edit_form_parent">
			<form class="edit_from" name="form1" action="{{APP_URL}}edit/addUser" method="get">
				<p class="cap" style="color: red; font-size: 5vw; margin: 0px 0px 0px 0px;">※不正な入力です。</p>
				<input class="edit_input" type="text" name="teamName" onkeydown="check_text()" onkeyup="check_text()" onchange="check_text()"></br>
				<input class="edit_submit load" type="button" name="btn" value="登録" onclick="disbtn(this)" disabled>
				<input type="hidden" name="gachavalue" value="12">
			</form>
		</div>
	</div>

	<script>
	$(function(){
        $("input"). keydown(function(e) {
            if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
                return false;
            } else {
                return true;
            }
        });
    });
	</script>


	
</div>
</div>
</div>
