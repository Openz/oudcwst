<?php

$_SESSION['lang_ref']=array("fr" => "fr_FR","en" => "en_EN");

if ( isset($_GET['hl']) && array_key_exists($_GET['hl'], $_SESSION['lang_ref']) ) {
	$_SESSION['lg']=$_GET['hl'];
	
}
else {
	$_SESSION['lg']='en';
}






?>
