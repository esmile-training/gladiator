<html>
<head>
  <meta charset="utf-8">
  <title>おみくじ</title>
</head>
おみくじのページへようこそ
<br><br>
<?php
$num = rand(0, 6);
if ($num == 0) {
echo "今日の運勢は大吉です。";
} else if ($num == 1){
echo "今日の運勢は中吉です。";
} else if ($num == 2){
echo "今日の運勢は小吉です。";
} else if ($num == 3){
echo "今日の運勢は吉です。";
} else if ($num == 4){
echo "今日の運勢は末吉です。";
} else if ($num == 5){
echo "今日の運勢は凶です。";
} else if ($num == 6){
echo "今日の運勢は大凶です。";
}
echo'<br>';
switch($num){
    case 0:
        echo "今日の運勢は大吉です。";
        break;
    case 1:
        echo "今日の運勢は中吉です。";
        break;
    case 2:
        echo "今日の運勢は小吉です。";
        break;
    case 3:
        echo "今日の運勢は吉です。";
        break;
    case 4:
        echo "今日の運勢は末吉です。";
        break;
    case 5:
        echo "今日の運勢は凶です。";
        break;
    case 6:
        echo "今日の運勢は大凶です。";
        break;
}

//アクセスカウンター
  $f = fopen("/vagrant/gladiator/resources/views/count.txt", "r+");
  $c = fgets($f, 10);
  $c = $c + 1;
  fseek($f, 0);
  fputs($f, $c);
  fclose($f);
?>
<p>ようこそ、<?php echo $_COOKIE['username'] ?>さん</p>
<p>ようこそ、<?php echo $_SESSION['username']?>さん</p>
<p>あなたは <?php echo $c; ?> 人目のお客様です。</p>
<?php //ハイパーリンク  ?>
<div>
    <a href="<?= APP_URL ?>top">
            topへ
    </a>
</div>

</body>
</html>