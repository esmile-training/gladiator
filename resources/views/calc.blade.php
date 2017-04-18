<div>
    <title>計算機跡地</title>
    <?php
    //ただの表示
    echo 'Hello,World!'.'<br>';    
    //変数の宣言とその表示
    $a = "apple";
    $b = "banana";
    $c = "chocorate";
    printf($a);
    echo ('<br>'.$b.'<br>');  
    //配列の宣言
    $array = array("foo", "bar", "hello", "world");
    //var_dump($array);    
    //配列の表示
    echo ($array[0].'<br>');
    printf($array[1]);
    echo ('<br>');   
    //特殊な配列の宣言と表示(添え字に文字を使用)
    //添え字に文字を使用すると数字での指定ができない？
    $array2 = array("apple" => "bug","banana"=>"monky","chocorate"=>"kids","dog"=>null);
    echo ($array2["apple"].'<br>');
    printf($array2["dog"]);   
    //関数の宣言と使用
    function hello ()
    {
	echo("hello");
	echo("<br>");
    }
    hello();    
    function plus($a,$b)
    {
	$c = $a + $b;
	return $c;
    }
    $d = plus(2, 5);
    echo ($d."<br>");    
    //for文の使用
    echo("九九の表".'<br>');
    for($aa = 1; $aa <= 9; $aa++)
    {
	for($bb = 1; $bb <= 9; $bb++){
	    echo($aa * $bb);
	}
	echo('<br>');
	$bb = 1;
    }
    echo 'カレンダー'.'<br>';
    for($cc = 1; $cc <= 31;)
    {
	for($dd = 1; $dd <= 7; $dd++)
	{
	    if($cc <= 31)
	    {
		echo $cc;
		$cc = $cc + 1;
	    } else {
		break;
	    }
	}
	echo '<br>';
    }
    echo '<br>';
    //if文の使用
    if($array2["apple"] === "bug")
    {
	echo ("badapple".'<br>');
    } else {
	echo ("good!".'<br>');
    }
    //phpからの脱出
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
?>
strposが非falseを返しました
あなたはInternet Explorerを使用しています
<?php
} else {
?>
<br>
strposがfalseを返しました
あなたはInternet Explorerを使用していません
<?php
}
    ?>
<?php

//トップへのリンク
echo '<br>';
echo '<a href="/">トップへ</a>'
?>
</div>