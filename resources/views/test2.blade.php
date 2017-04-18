<title>テストページ2</title>
<div>
  <?php
  date_default_timezone_set('Asia/Tokyo');
  echo date("Y 年 m 月 d 日 H 時 i 分 s 秒");
  echo('<br>');
if (isset($_SERVER['HTTP_REFERER'])) {
    $x = htmlspecialchars($_SERVER['HTTP_REFERER']);
    echo "あなたは $x のリンクをたどって来ましたね";
  } else {
    echo "あなたはリンクをたどらずにこのページに来ましたね";
  }
    echo('<br>');
   if (isset($_SERVER['HTTP_REFERER'])) {
    echo '<a href="', htmlspecialchars($_SERVER['HTTP_REFERER']), '">［戻る］</a>'.'<br>';
  }
  //php内でのHTML出力は基本echoで出力する
  ?>
    <br>

</div>