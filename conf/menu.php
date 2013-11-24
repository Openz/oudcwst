<?php
/*$menu = '<li><a href="index_'. $_SESSION['lg'] .'.php">&nbsp;'. _("Project") .'&nbsp;</a></li>';
$menu .= '<li><a href="install_'. $_SESSION['lg'] .'.php">&nbsp;'. _("Install") .'&nbsp;</a></li>';
$menu .= '<li><a href="contribute_'. $_SESSION['lg'] .'.php">&nbsp;'. _("Contribute") .'&nbsp;</a></li>';
$menu .= '<li><a href="contact_'. $_SESSION['lg'] .'.php">&nbsp;'. _("Contact") .'&nbsp;</a></li>';
$menu .= '<li><a href="faq_'. $_SESSION['lg'] .'.php">&nbsp;'. _("FAQ") .'&nbsp;</a></li>';*/
echo '	<div class="row">
			<div class="span9">
				<ul class="breadcrumb">';

echo '<li><a href="index_'. $_SESSION['lg'] .'.php">'. _("Project") .'</a></li>';
echo '<li><a href="install_'. $_SESSION['lg'] .'.php">'. _("Install") .'</a></li>';
echo '<li><a href="contribute_'. $_SESSION['lg'] .'.php">'. _("Contribute") .'</a></li>';
echo '<li><a href="contact_'. $_SESSION['lg'] .'.php">'. _("Contact") .'</a></li>';
echo '<li><a href="faq_'. $_SESSION['lg'] .'.php">'. _("FAQ") .'</a></li>';

echo '				</ul>';
echo '			</div>';
echo '			<div class="span3"><ul class="breadcrumb"><li><a href="'. $page .'_en.php">EN</a></li><li><a href="'. $page .'_fr.php">FR</a></li></ul></div>';
echo '	</div>';

?>
