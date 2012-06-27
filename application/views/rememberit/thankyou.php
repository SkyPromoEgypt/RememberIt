<?php
use application\models as Models; 
if(getPost () == 'edit') {
	$account = Models\User::find_by_id(getId());
}
?>
<html>
<head>
<title>Welcome to RememberIT | User Accounts</title>
<link href="<?php echo CSS_PATH. "/"; ?>main_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH. "/"; ?>form.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH. "/"; ?>iefix.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo JAVASCRIPT_PATH . "/lib/core.js"; ?>"></script>
<script type="text/javascript" src="<?php echo JAVASCRIPT_PATH . "/tooltip.js"; ?>"></script>
</head>

<body>
<div id="wrraper">
<?php include_once LAYOUT_PATH . "/topmenu.php"; ?>
<h1><img src=<?php echo IMAGES_PATH . "/logo.png"; ?> /></h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="register">
<form action="" method="post" class="form">
<table style="float:left;">
	<tr>
		<td colspan="2"><?php echo output_message(); ?></td>
	</tr>
</table>
</form>
<div style="float:left; width:950px;"></div>
</div>
<div id="footer" style="clear:both; margin-top:50px;">
<hr />
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