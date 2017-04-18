<html>
    <head>
        <meta charset="UTF-8">
        <title>テストページ3</title>
    </head>
    <body>
	<?php
	echo 'testpage3'.'<br>';
	//フルパスでべた読み
	$sentm = date("Y 年 m 月 d 日 H 時 i 分 s 秒");
	echo App\http\Controllers\Test3Controller::tetet($sentm).'<br>';
	echo $player['name']."<br>";
	echo $player["age"]."<br>";
	echo $player["seibetsu"]."<br>";
	?>
	<!--
	<form action="sample" method="get">
	    <input type="text" name="username" value="">
	    <br>
	    <input type="submit" value="ログイン">
	</form>
	<input type="button" onclick="location.href='makeuser'" value="新規登録">
	-->
    </body>
</html>
