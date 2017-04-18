<?php
  if (isset($_POST['message']) && $_POST['message'] != "") {
    $f = fopen("message.txt", "a");
    fwrite($f, htmlspecialchars($_POST['message']) . "\n");
    fclose($f);
  }
?>

<form action="append.php" method="post">
<p>メッセージ: <input name="message" size="60"></p>
</form>

<pre>
<?php readfile("/vagrant/gladiator/resources/views/message.txt"); ?>
</pre>