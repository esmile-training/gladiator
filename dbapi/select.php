<?php
require_once './dbapi.php';

//jsonに変換して表示
while($row = mysql_fetch_assoc($result)){
	$record[] = $row;
}
if( isset($record) ){
	$json= json_encode( $record );
	print( $json );
} else {
	echo "{}";
}

//DB閉じる
mysql_close($link);

?>
