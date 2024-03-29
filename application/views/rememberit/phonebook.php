<?php checkValidity(); ?>
<?php use application\models as Models; ?>
<?php 
if(getPost () == 'edit') {
	$accObj = Models\PhoneBook::find_by_id(getId());
	if($accObj->user_id == $_SESSION['userId']) {
		$account = $accObj;
	}
}
?>
<html>
<head>
<title>Welcome to RememberIT | Websites Accounts</title>
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
	<?php if (getPost() != 'delete'): ?>
	<tr>
		<td><label for="firstname">First Name:</label></td>
		<td><input type="text" id="firstname" name="firstname" class="input" value="<?php 
		echo $account->firstname;
		if(!$_SESSION['success']) echo $_POST['firstname'];  
		?>" /></td>
	</tr>
	<tr>
		<td><label for="lastname">Last Name:</label></td>
		<td><input type="text" id="lastname" name="lastname" class="input" value="<?php 
		echo $account->lastname; 
		if(!$_SESSION['success']) echo $_POST['lastname']; 
		?>" /></td>
	</tr>
	<tr>
		<td><label for="telephone">Telephone:</label></td>
		<td><input type="text" id="telephone" name="telephone" class="input" value="<?php 
		echo $account->telephone;
		if(!$_SESSION['success']) echo $_POST['lastname']; 
		?>" /></td>
	</tr>
	<tr>
		<td><label for="mobile">Mobile:</label></td>
		<td><input type="text" id="mobile" name="mobile" class="input" value="<?php 
		echo $account->mobile; 
		if(!$_SESSION['success']) echo $_POST['mobile'];
		?>" /></td>
	</tr>
	<tr>
		<td><label for="work">Work:</label></td>
		<td><input type="text" id="work" name="work" class="input" value="<?php 
		echo $account->work; 
		if(!$_SESSION['success']) echo $_POST['work'];
		?>" /></td>
	</tr>
	<tr>
		<td><label for="pager">Pager:</label></td>
		<td><input type="text" id="pager" name="pager" class="input" value="<?php 
		echo $account->pager; 
		if(!$_SESSION['success']) echo $_POST['pager'];
		?>" /></td>
	</tr>
	<tr>
		<td><label for="email">Email:</label></td>
		<td><input type="text" id="email" name="email" class="input" value="<?php 
		echo $account->email; 
		if(!$_SESSION['success']) echo $_POST['email'];
		?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" id="submit" name="submit" class="submit" value="<?php if(getPost() == 'edit') echo "Edit"; else echo "Add";?> Account" /></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="2"><?php echo output_message(); output_form_errors(); if($_SESSION['success']) $_SESSION['success'] = false; ?></td>
	</tr>
</table>
<table>
<tr>
<td>
<h1 style="color:#6c1c18;"><img src=<?php echo IMAGES_PATH . "/icons/phonebook.png"; ?> align="top" />Phone Book Directory</h1>
<p>Here you can add, edit or delete your phone accounts. 
For instance if you have a phone account all you need is to enter the details as follows in the example.</p><br />
<p class="msg">Example:</p>
<p>First Name: Michael</p>
<p>Last Name: Stevenson</p>
<p>Telephone: +36521547458</p>
<p>Mobile: +2015415424</p>
<p>Work: +36525421587</p>
<p>Pager: +36518745368</p>
<p>email: mstevenson1@hotmail.com</p>
</td>
</tr>
</table>
</form>
<div style="float:left; width:950px;"><?php echo Models\PhoneBook::renderForControl(); ?></div>
</div>
<div id="footer" style="clear:both; margin-top:50px;">
<hr />
<p>This service is free of charge. Designed and Developed by Datab TEchnology for Solutions Development.</p>
<p>Copyrights � <?php echo date("Y"); ?>. All rights reserved to <strong><a href="http://www.dahabtech.com" class="dttooltip" title="Dahab TEchnology for Solutions Development">Dahab TEchnology</a></strong>.</p>
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