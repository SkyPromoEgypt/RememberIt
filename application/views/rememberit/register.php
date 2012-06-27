<?php use application\models as Models; ?>
<?php 
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
<h1><img src=<?php echo IMAGES_PATH . "/logo.png"; ?> /></h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="register">
<form action="" method="post" class="form">
<table style="float:left;">
	<tr>
		<td><label for="firstname">First Name:</label></td>
		<td><input type="text" id="firstname" name="firstname" class="input" value="<?php echo $_POST['firstname']; ?>" /></td>
	</tr>
	<tr>
		<td><label for="lastname">Last Name:</label></td>
		<td><input type="text" id="lastname" name="lastname" class="input" value="<?php echo $_POST['lastname']; ?>" /></td>
	</tr>
	<tr>
		<td><label for="username">Username:</label></td>
		<td><input type="text" id="username" name="username" class="input" /></td>
	</tr>
	<tr>
		<td><label for="password">Password:</label></td>
		<td><input type="password" id="password" name="password" class="input" /></td>
	</tr>
	<tr>
		<td><label for="cpassword">Confirm Password:</label></td>
		<td><input type="password" id="cpassword" name="cpassword" class="input" /></td>
	</tr>
	<tr>
		<td><label for="email">Email:</label></td>
		<td><input type="text" id="email" name="email" class="input" value="<?php echo $_POST['email']; ?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><p><input type="checkbox" id="agree" name="agree"  /> I agree on the terms and conditions</p><p>and ready to register.</p></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" id="submit" name="submit" class="submit" value="Register" /></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo output_message(); output_form_errors(); ?></td>
	</tr>
</table>
<table>
<tr>
<td>
<h1 style="color:#b3720e;"><img src=<?php echo IMAGES_PATH . "/icons/register.png"; ?> align="top" />Register Your Account</h1>
<h5>Use the form to register your account. After registering an email will be forwarded to you with an activation code. Make sure to activate you account to be able to use our services.</h5>
<h5>Please make sure to read our <a id="terms" href="javascript:void(0);" class="dttooltip" title="Read our Terms and Conditions.">Terms and Conditions</a> before registering your account.</h5>
</td>
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