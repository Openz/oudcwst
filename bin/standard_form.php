<?php

$reference = array(
	"text_table"=>array(
		"text"=>600,
	),
	"argument_table"=>array(
		"text"=>210,
		"link"=>100,
	),
	"referendum_table"=>array(
		"question"=>120,
		"thesis"=>120,
		"anti-thesis"=>120,
		"note"=>80,
		"wiki_link"=>100,

	),
	"link_table"=>array(
		"text"=>120,
		"link"=>100,
	)
);

function sql_check($input){

	$ck=stripcslashes($input);
	// remplacer parenteses
	$key1=array('(', ')');
	$key2=array('%28', '%29');
	$ck2=str_replace($key1, $key2, $ck);
	if (preg_match("#<|>|\sor\s|\sand\s|union|where|from|select|;|=#i", $ck2)){
		include("./bin/attaque.php");
	}
	else {
		return $ck2;
	}
}

function close_form_page($action,$back) {
	
	unset($_SESSION['form']);
	echo '<p> '. $action .'  </p>' ;
	echo $back ;
	echo $_SESSION['html_close'];
	exit();
}

// # Reception des valeurs de fomulaire
if ( isset($_POST['reset']) ) { 
	close_form_page($_SESSION['text']['canceled'],$back);
}


if ( isset($_POST['formkey']) ) {

	foreach ($form as $key => $value) {

		if(isset($reference[$sql_table][$value])){
			$max_len=$reference[$sql_table][$value];
		}
		else {
			$max_len=50;
		}

		if (! empty($_POST[$value])) {
			$uline=sql_check($_POST[$value]);
			$_SESSION['form'][$value]=htmlspecialchars($uline, ENT_QUOTES);
			if (preg_match("#\r\n|\n#", $_SESSION['form'][$value])){
				$erreur="1";
				$erreur_msg=$_SESSION['text']['form_error_backline'];
			}
			if (strlen($_SESSION['form'][$value]) > $max_len ){
				$erreur="1";
				$erreur_msg=$_SESSION['text']['form_error_long'];
			}
	
		}
		else {
			$erreur="1";
		}

	}

	if(isset($form_option)){
		foreach ($form_option as $key => $value) {

			if(isset($reference[$sql_table][$value])){
				$max_len=$reference[$sql_table][$value];
			}
			else {
				$max_len=50;
			}

			if (! empty($_POST[$value])) {
				$uline=sql_check($_POST[$value]);
				$_SESSION['form'][$value]=htmlspecialchars($uline, ENT_QUOTES);
				if (preg_match("#\r\n|\n#", $_SESSION['form'][$value])){
					$erreur="1";
					$erreur_msg=$_SESSION['text']['form_error_backline'];
				}
				if (strlen($_SESSION['form'][$value]) > $max_len ){
					$erreur="1";
					$erreur_msg=$_SESSION['text']['form_error_long'];
				}

				// check mail et pass

			}
		}
	}


	// Ajout d'une entrée
	if ( !isset($erreur) ) {

		$sql_into="";
		$sql_value="";
		foreach ($_SESSION['form'] as $key => $value) {
			if ( strlen($value) > 0  ) {
				$sql_into  .= "\"". $key   ."\","; 
				if (preg_match("#\(|\)#",$value )){ // Remove ' if select commande
					$sql_value .= $value .",";
				}
				else {
					$sql_value .= "'".  $value ."',";
				}
			}
		}
		include("./conf/conf_strict.php");
		include("./core/bin/db_write.php");
		pg_query($dbwrite, "begin");

		if (isset($query_beg)) {
			$query = $query_beg ;
		}
		else {
		$query  = '';
		}

		$query  .= ' INSERT INTO "'. $sql_table .'" (';
		$query .= substr($sql_into,0,-1);
		$query .= ')' ;

		$query .= ' VALUES (';
		$query .= substr($sql_value,0,-1);
		$query .= ') ;' ;


		if (isset($query_sup)) {
			$query .= $query_sup ;
		}


		$result = pg_query($dbwrite,$query) or die(close_page(""));


		pg_query($dbwrite, "commit");
		pg_close($dbwrite);
		close_form_page($_SESSION['text']['sended'],$back);

	}

	if ( isset($erreur)  ) {
	echo $back;
	echo '<p>'.$_SESSION['text']['form_error'] .'</p>';;
		if ( isset($erreur_msg)  ) {
		echo '<p><span style="color:red">'.$erreur_msg .'</span></p>';
		}
	}



}

if(isset($form_titre)){
	echo '<h1>'. $form_titre .'</h1>';
}

echo '<form method="post" action="'. $_SERVER['PHP_SELF'] .'" >';

foreach ( $form as $key => $value) {
	$filled="";
	if ( isset($_SESSION['form'][$value])) {
		$filled=$_SESSION['form'][$value];
	}

	echo '<h2>'. $_SESSION['text'][$value] .'</h2>';
	if (isset($_SESSION['text'][$value.'_desc'])){
		echo '<p>'.$_SESSION['text'][$value.'_desc'].'</p>';
	}
	echo '<p><input type="text"  name="'. $value .'" value="'. $filled .'" /></p>';
}

if(isset($form_option)){


	echo '<h2>'.$_SESSION['text']['option'].'</h2>';
	foreach ( $form_option as $key => $value) {
		$filled="";
		if ( isset($_SESSION['form'][$value])) {
			$filled=$_SESSION['form'][$value];
		}

		echo '<h3>'.$_SESSION['text'][$value].'</h3>';

		if (isset($_SESSION['text'][$value.'_desc'])){
			echo '<p>'.$_SESSION['text'][$value.'_desc'].'</p>';
		}

	echo '<p><input type="text"  name="'. $value .'" value="'. $filled .'" /></p>';
	}
}





echo '<p><input type="hidden" name="formkey" value="1" />';
echo '<input type="submit" id="submit" value="'. $_SESSION['text']['send'] .'" /></p>';
echo '</form>';

echo'<form action="'. $_SERVER['PHP_SELF']  . '" method="post"><p>
<input value="'. $_SESSION['text']['cancel'] .'" type="submit" name="reset" />
</p></form>';


?>
