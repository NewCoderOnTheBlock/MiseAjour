<div style="margin:auto;width:100%;text-align:center;">
	<form method="post" action="secu.php">
		<?php 
		if (isset($_GET['msg_error'])){
			echo "<br />".$_GET['msg_error']."<br /><br />"; 
		}
		?>
		Veuillez vous identifier
		<br />
		<table style="margin:auto;text-align;center;">
			<tr>
				<td>Login : &nbsp;</td>
				<td><input type="texte" name="log" id="inputLog" size="10"></td>
			</tr>
			<tr>
				<td>Pass :&nbsp;</td>
				<td><input type="password" name="pass" size="10"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Connexion">
				</td>
			</tr>
		</table>
	</form>
</div>

<script type="text/javascript">
<!--
	document.getElementById('inputLog').focus(); 
//-->
</script>