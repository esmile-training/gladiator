<html>
    <head>
        <title>テストページ</title>
    </head>
    <body>
        テストページへようこそ！<br>
        ここでは実験的に書かれたコードが乱雑に実行されるよ。<br>
        
        <?php
        echo '<p>Hello World</p>' . $_SERVER['HTTP_USER_AGENT'];
        ?>
	
        <p>この部分は PHP から無視され、そのままブラウザには表示されます。</p>
        <?php echo '一方、この部分はパースされます。'; ?>
        <p>この部分も PHP から無視され、そのままブラウザには表示されます。</p>
        
        <?php
        $foo = 'Bob';              // 値'Bob'を$fooに代入する。
        $bar = &$foo;              // $fooを$barにより参照
        $bar = "My name is $bar";  // $barを変更...
        echo $bar;
        echo '<br>'.'<h4>'.'<i>'.'<u>';
        echo $foo.'</h4>'.'</i>'.'</u>';                 // $fooも変更される。
        
        var_dump($bar);
        echo '私の名前はボブです';
        
        $array = array(
        "foo" => "bar",
        "bar" => "foo",
        );
        
        $array = array(
        1    => "a",
        "1"  => "b",
        1.5  => "c",
        true => "d",
        );
        var_dump($array);
        
	//fruitという配列があってその要素
        $fruits = array (
        "fruits"  => array("a" => "orange", "b" => "banana", "c" => "apple"),
        "numbers" => array(1, 2, 3, 4, 5, 6),
        "holes"   => array("first", 5 => "second", "third")
        );
	echo '<br>';
        print_r($fruits);
        echo '<br>';
        $array = array(1, 1, 1, 1,  1, 8 => 1,  4 => 1, 19, 3 => 13);
        print_r($array);   
	
        ?>
    </body>
</html>