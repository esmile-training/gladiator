@include('common/css', ['file' => 'changeUserName'])
@include('common/js', ['file' => 'edit'])

<h1 class="changeName_title">剣闘士団名を変えられます</h1>
<h4 class="changeName_subtitle">※全角８文字以内</h4>

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

<form class="changeName_form" name="form1" action="{{APP_URL}}changeUserName/changeName" method="get">
	<p class='caution cap'>※不正な入力です。</p>
	<input class="changeName_input" type="text" name="teamName" onkeydown="check_text()" onkeyup="check_text()" onchange="check_text()"></br>
	<input class="changeName_submit load" type="button" name="btn" value="登録" onclick="disbtn(this)" disabled>
</form>