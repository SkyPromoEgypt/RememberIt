<html>
<head>
<title>Welcome to RememberIT</title>
<link type="text/css" rel="stylesheet" href="/min/b=css&amp;f=main_css.css,form.css,iefix.css" />
<script type="text/javascript" src="/min/b=javascript&amp;f=lib/jquery.js,lib/core.js,tooltip.js,actions.js"></script>
</head>

<body>
<a href="javasciprt:void(0);" class='closepopup'></a>
<div class="window"><?php includeAjaxViews(); ?></div>
<div id="overlay"></div>
<div id="wrraper">
<img src=<?php echo IMAGES_PATH . "/logo.png"; ?> style="margin-left:5px;" />
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="popup">
<?php 
	if (!$_SESSION['loggedIn']) {
		echo "
		<p class=\"definition\">RememberIT is a free service that helps you to store your accounts easily and saftely so you can restore them any time you want. 
		Use RememberIT to backup your Websites logins, PC users, Mobile Applications users, Email accounts, Database credentials and more. The main Idea of this services
		is to let you store all of your important accounts online so they can be retrieved easily anywhere and if you sudden to have any data loss. 
		For any feedbacks or suggestins please email us at 
		<a href=\"mailto:mohammed@dahabtech.com\" style=\"display: inline; float: none; margin: 0; text-align: left;\">mohammed@dahabtech.com</a></p><br/><br/>
		<h3 style=\"text-align:center;\">Welcome to RememberIt. Please login to your account.</h3><br/>";
		include_once LAYOUT_PATH . "/loginform.php";
	} else {
		$user = \application\models\User::find_by_id($_SESSION['userId']);
		if($user->status != "Active") {
			echo "<h1 style=\"text-align:center;\">Please Activate your Account to be able to use RememberIt.</h1>";
			include_once LAYOUT_PATH . "/activationform.php";
		} else {
			include_once LAYOUT_PATH . "/mainmenu.php";
		}
	}
?>
</div>
<div id="footer">
<p>This service is free of charge. Designed and Developed by Datab TEchnology for Solutions Development.</p>
<p>Copyrights © <?php echo date("Y"); ?>. All rights reserved to <strong><a href="http://www.dahabtech.com" class="dttooltip" title="Dahab TEchnology for Solutions Development">Dahab TEchnology</a></strong>.</p>
<br />
<div id="browsers">
        <p>For best browsing this service please use the following browsers</p>
        <p>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" target="_blank" title="Download Microsoft Internet Explorer" class="dttooltip"><img src=<?php echo IMAGES_PATH . "/icons/ieicon.png"; ?> width="30" height="30" /></a>
        <a href="http://www.mozilla.com" target="_blank" title="Download Mozilla Firefox" class="dttooltip"><img src=<?php echo IMAGES_PATH . "/icons/firefoxicon.png"; ?> width="30" height="30" /></a>
        <a href="http://www.google.com/chrome/" target="_blank" title="Download Google Chrome" class="dttooltip"><img src=<?php echo IMAGES_PATH . "/icons/gchromeicon.png"; ?> width="30" height="30" /></a>
        <a href="http://www.opera.com" target="_blank" title="Download Opera" class="dttooltip"><img src=<?php echo IMAGES_PATH . "/icons/operaicon.png"; ?> width="30" height="30" /></a>
        <a href="http://www.apple.com/safari/download/" target="_blank" title="Download Safari" class="dttooltip"><img src=<?php echo IMAGES_PATH . "/icons/safariicon.png"; ?> width="30" height="30" /></a>
        </p>
      </div>
</div>
</div>
</body>
</html>