<?php

// color: #008000;
if (! isset( $_SESSION['lg'] ) OR isset($_GET['hl']) ) {
	include_once("./bin/lang.php");
}


$lang= $_SESSION['lang_ref'][$_SESSION['lg']].'.utf8';
$filename="message";
putenv("LC_ALL=$lang");
setlocale(LC_ALL, $lang);
bindtextdomain($filename, './locale');
bind_textdomain_codeset($filename, "UTF-8");
textdomain($filename);

//if (! isset( $_SESSION['conf'] ) ) {
//	$_SESSION['conf']="1";
//	include_once("./bin/conf.php");
//}

if (! isset( $_SESSION['init'] ) ) {
	include_once("./conf/init.php");
}

function close_page() {
exit();
}

function get_image_in_langage($im,$ext,$width,$coment){

	$file = $im .'_'. $_SESSION['lg'] .'.'. $ext;

	if (! file_exists($file)) {
		$file = $im .'_en.'. $ext;
	}

	$result = ' <div class="polaroid align-center"><object data="';
	$result .= $file .'"';
	$result .= ' width="'. $width .'"';	
	$result .= ' type="image/svg+xml"></object><div class="fig_comment">';
	$result .= $coment;
	$result .= ' </div></div>';

	print $result;

}


function get_image($im,$ext,$width,$coment){

	$file = $im .'.'. $ext;

	$result = ' <div class="polaroid align-center"><object data="';
	$result .= $file .'"';
	$result .= ' width="'. $width .'"';	
	$result .= ' type="image/svg+xml"></object><div class="fig_comment">';
	$result .= $coment;
	$result .= ' </div></div>';

	print $result;

}

// get_image_in_langage("src/pay2","svg","80%","A donne de l'argent à B (transaction mode2)")
// <div class="polaroid align-center"><object data="src/pay1_fr.svg" width="80%" type="image/svg+xml"></object><div class="fig_comment">A donne de l'argent à B (transaction mode1)</div></div>
// <div class="polaroid align-center"><object width="80%" type="image/svg+xml" data="src/pay1_en.svg"/>	<div class="fig_comment">A donne de l'argent à B (transaction mode1) </div></div>



function head_page($pid) {
// Page xhtml


	include_once("./text/". $pid ."_conf.php");

	$GLOBALS["lock_hp"]=1;
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="'. strtolower($_SESSION['lg']) .'" xmlns="http://www.w3.org/1999/xhtml" lang="'. strtolower($_SESSION['lg']) .'">
<head>';

	echo "\n";
	echo '<title>'. $title .'</title> ';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
	echo "\n";
	echo '<meta name="description" content="'. $description .'" />';
	echo "\n";
	echo '<meta name="keywords" content="'. $keywords .'" /> ';

	echo "\n";
	echo '<link href="css/ministrap.css" rel="stylesheet" type="text/css" />';
	echo "\n";
	echo '<link href="css/perso.css" rel="stylesheet" type="text/css" />';
	echo "\n";
	echo '
</head>
<body class="with-top-bar">
	';

}

head_page('0');

echo '<script type="text/javascript" src="js/jquery.js"></script>';
echo '<script type="text/javascript" src="js/jquery.ministrap.min.js"></script>';

echo "\n";

include_once("./conf/top-bar.php");

echo "\n";

echo '
<div class="container">';

include_once("./conf/menu.php");

echo '
	<div class="row">

			<div class="span9">';

			include_once("./text/".$pid.".php");

echo '
		</div>';

echo '
			<div class="span3">
				<div class="align-center" >
					<a href="index.php"><img src="img/logo-open-udc.svg" alt="Logo"  width="80%" /></a>

				</div>
			</div>

		</div>';

		
echo '
	</div>';


echo '<div class="bottom-bar">';
echo $_SESSION['bar'];

echo '
</div>';

echo'  </body>
</html>';

?>
