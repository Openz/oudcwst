<?php
$dbread = pg_connect('host='. $pg_host .' dbname='. $db_name .' user='. $uname_read .'  password='. $pname_read .'') or die(close_page($_SESSION['text']['error_con']));
?>
