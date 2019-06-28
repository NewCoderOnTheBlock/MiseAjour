<?php session_start(); 
/*
si la variable de session login n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if (!isset($_SESSION['user'])  ) { 
   //header ('Location: index.php'); 
   echo '<script language="Javascript">
		<!--
		document.location.replace("index.html");
		// -->
		</script>'; 
  exit();  
 } 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>Supprimer 1 saisie Renault</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	
	<h1>Supprimer 1 saisie Renault</h1>

	<?php
	  include("menu.php");
	  ?>
<br><br><br><br><br><br><br><br>
<form method="post" action= "sup2_renault.php">
	<fieldset class="field">
		<label>ID :</label>
			<input type="texte" name="id" size="10" ONFOCUS='this.value=""'><p>
	</fieldset>
	<p>
		
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	
</form>

</div>
</body>
</html>