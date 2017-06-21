@include('common/js', ['file' => 'edit'])
@include('common/css', ['file' => 'edit'])
@include('common/css', ['file' => 'modal'])
<script type="text/javascript" src="{{APP_URL}}js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{APP_URL}}js/load.js"></script>
<div><img class = "edit_logo editload" src = "{{IMG_URL}}edit/editLogo.png"></div>
<div>				
	<img class = "edit_load backload"src = "{{IMG_URL}}title/titlelodoDown.gif">
</div>
<div class = "editload">
<div align="center">

	<div class="edit_frame">
		<h1 class="edit_title">名前入力</h1>
		<h4 class="edit_subtitle">※全角８文字以内</h4>
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popuptop.png" />
		<img class="edit_frame_img" style="height: 20%;" src="{{IMG_URL}}popup/popupmiddle.png" />
		<img class="edit_frame_img" src="{{IMG_URL}}popup/popupbottom.png" />
	
		<form class="edit_from" name="form1" action="{{APP_URL}}edit/addUser" method="get">
			<p class="cap" style="color: red; font-size: 5vw; margin: 0px 0px 0px 0px;">※不正な入力です。</p>
			<input class="edit_input" type="text" name="teamName" onkeydown="copy_text()" onkeyup="copy_text()" onchange="copy_text()"></br>
			<input class="edit_submit load" type="button" name="btn" value="登録" onclick="disbtn(this)" disabled>
			<input type="hidden" name="gachavalue" value="12">
		</form>
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
	function copy_text()
	{
		 if((document.form1.teamName.value.match(/^[^ -~｡-ﾟ]*$/) || document.form1.teamName.value.match(/\"\'/)) && document.form1.teamName.value.length < 9 && document.form1.teamName.value.length > 0)
		 {		
			$(".cap").removeClass("act");
			document.form1.btn.disabled = "";
		 } else {
			$(".cap").addClass("act");
			document.form1.btn.disabled = "true";
		 }
	}
	</script>

	<style>
	.cap:not(.act) {
		display:none;
	}
	</style>
	
</div>
</div>
