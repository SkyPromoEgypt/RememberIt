<form class="form2" id="loginForm" method="post" action="">
<table align="center">
	<tr>
		<td align="left" valign="top"><label for="username">Username</label></td>
		<td align="left" valign="top"><input name="username" type="text" class="input" id="username" /></td>
		<td align="left" valign="top"><input type="submit" class="submit" name="submit" id="submit" value="Login" /></td>
	</tr>
	<tr>
		<td align="left" valign="top"><label for="password">Password</label></td>
		<td align="left" valign="top"><input name="password" type="password" class="input" id="password" /></td>
		<td align="left" valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top">
		<p>Don't have an account? <a href="<?php echo SITENAME . "/rememberit/register"; ?>" class="dttooltip" title="Click here to register for an account.">Click here.</a></p>
		<p>Forgot your password? <a href="<?php echo SITENAME . "/rememberit/resetpassword"; ?>" class="dttooltip" title="Reset your password.">Click here.</a></p>
		</td>
		<td align="left" valign="top">&nbsp;</td>		
	</tr>
	<tr>
		<td colspan="3"><?php echo output_message(); ?></td>
	</tr>
</table>
</form>