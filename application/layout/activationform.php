<form class="form2" id="activationForm" method="post" action="">
<table align="center">
	<tr>
		<td align="left" valign="top"><label for="activation">Activation Code:</label></td>
		<td align="left" valign="top"><input name="activation" type="text" class="input" id="activation" /></td>
		<td align="left" valign="top"><input type="submit" class="submit" name="activate" id="activate" value="Activate" /></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo output_message(); ?></td>
	</tr>
</table>
</form>