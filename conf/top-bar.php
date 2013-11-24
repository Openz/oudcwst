<?php



echo '<div class="top-bar">
	<div class="container">
		<div class="row">
			<div class="span3 align-left" >
				<a href="index.php" class="logo">OpenUDC</a>
			</div>
				<div class="span9 align-right" >

					<ul class="menu" >
						<li class="has-sub">
								<a href="index.php">Home</a>

								<ul class="sub-menu">';

echo '<li><a href="index_'. $_SESSION['lg'] .'.php">'. _("Project") .'&nbsp</a></li>';
echo '<li><a href="install_'. $_SESSION['lg'] .'.php">'. _("Install") .'&nbsp;</a></li>';
echo '<li><a href="contribute_'. $_SESSION['lg'] .'.php">'. _("Contribute") .'&nbsp;</a></li>';
echo '<li><a href="contact_'. $_SESSION['lg'] .'.php">'. _("Contact") .'&nbsp;</a></li>';
echo '<li><a href="faq_'. $_SESSION['lg'] .'.php">'. _("FAQ") .'&nbsp;</a></li>';
echo '								</ul>
						</li>
						<li><a href="http://openudc.org">Blog</a></li>
						<li><a href="https://github.com/Open-UDC">GitHub</a></li>	
					</ul>	
				</div>
		</div>
	</div>
</div>';

?>

