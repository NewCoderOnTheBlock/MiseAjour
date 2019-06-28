

	<form method="post" action="secu.php">
    <div style=" margin:auto; width:200px;">
    <br />
    <br />
    	<?php echo $_GET['msg_error']."<br> "; ?>Veuillez Vous identifier
     <br />
		<table>
			<tr><td>Login : &nbsp;</td><td><input type="texte" name="log" size="10"></td></tr>
			<tr><td>Pass :&nbsp;</td><td><input type="password" name="pass" size="10"></td></tr>
			<tr><td colspan="2" align="center"><input type="submit" value="LOG"><input type="reset" value="effacer"></td></tr>
		</table>
       </div>
	</form>