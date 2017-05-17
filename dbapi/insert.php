<?php

require_once './dbapi.php';

if( $result ){
	$result = mysql_insert_id();
}

print( $result );
exit;

?>
