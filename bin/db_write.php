<?php
$dbwrite = pg_connect("host=". $pg_host ." dbname=". $db_name ." user=". $uname_write ." password=". $pname_write) or die(close_page($_SESSION['text']['error_con']));
?>
