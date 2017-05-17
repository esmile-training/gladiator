<?php
//設定
$dsn = 'mysql300.db.sakura.ne.jp:3306';
$username = 'esmile-sys';
$password = 'esmile00';

//MySQL接続
$link = mysql_connect($dsn, $username, $password);

//失敗処理
if (!$link) {
	print(mysql_error());
}

//DB指定
$db_selected = mysql_select_db('esmile-sys_gladiator', $link);
if (!$db_selected) {
	print(mysql_error());
}

//文字コード指定
mysql_set_charset('utf8');

//クエリ実行
$sql = $_REQUEST['sql'];
$result = mysql_query( $sql );
if (!$result) {
	$message  = 'Invalid query: ' . mysql_error() . "\n";
	$message .= 'Whole query: ' . $sql;
	print($message);
}


?>

