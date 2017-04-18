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
	var_dump(App\Http\Controllers\sampleController::$kekka);
	?>

    </body>
</html>
