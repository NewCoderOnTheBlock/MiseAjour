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

<title>gestion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	
	<h1>Gestion</h1>

	<?php
	  include("menu.php");
	  ?>
<br><br><br><br><br><br><br><br>
<form method="post" action= "gestion1.php">
	<fieldset class="field">
	<legend>Téléphone</legend>
		<label>Gestionnaire :</label>
			<input type="texte" name="gestionnaire" size="30"><p>
		<label>1ere Demande Renseignements : Tarifs</label>
			<input type="texte" name="tarifs" size="30" ><br>
		<label>1ere Demande Renseignements : Horaires</label>
			<input type="texte" name="horaires" size="30" ><br>
		<label>1ere Demande Renseignements : Points de rassemblements</label>
			<input type="texte" name="rassemblement" size="30" ><br>
		<label>Validation Réservation : </label>
			<input type="texte" name="validation" size="30"><p>
		<label>Problèmes Tech Paiement :</label>
			<input type="texte" name="paiement" size="30"><p>
		<label>Problèmes Tech Autres :</label>
			<input type="texte" name="autres" size="30"><p>
		<label>Suivi Demande :</label>
			<input type="texte" name="suivi" size="30"><p>
		<label>Suivi Réservation Client :</label>
			<input type="texte" name="client" size="30"><p>
		<label>Suivi Réservation Gestionnaire :</label>
			<input type="texte" name="suivi_gestionnaire" size="30"><p>
	</fieldset>
			
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	
</form>


<form method="post" action= "gestion2.php">
	<fieldset class="field">
	<legend>Internet</legend>
		<label>Gestionnaire :</label>
			<input type="texte" name="gestionnaire" size="30"><p>
		<label>1ere Demande Renseignements : Tarifs</label>
			<input type="texte" name="tarifs" size="30" ><br>
		<label>1ere Demande Renseignements : Horaires</label>
			<input type="texte" name="horaires" size="30" ><br>
		<label>1ere Demande Renseignements : Points de rassemblements</label>
			<input type="texte" name="rassemblement" size="30" ><br>
		<label>Validation Réservation : </label>
			<input type="texte" name="validation" size="30"><p>
		<label>Problèmes Tech Paiement :</label>
			<input type="texte" name="paiement" size="30"><p>
		<label>Problèmes Tech Autres :</label>
			<input type="texte" name="autres" size="30"><p>
		<label>Suivi Demande :</label>
			<input type="texte" name="suivi" size="30"><p>
		<label>Suivi Réservation Client :</label>
			<input type="texte" name="client" size="30"><p>
		<label>Suivi Réservation Gestionnaire :</label>
			<input type="texte" name="suivi_gestionnaire" size="30"><p>
	</fieldset>
			
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	
</form>



<form method="post" action= "gestion3.php">
	<fieldset class="field">
	<legend>Bureau</legend>
		<label>Gestionnaire :</label>
			<input type="texte" name="gestionnaire" size="30"><p>
		<label>1ere Demande Renseignements : Tarifs</label>
			<input type="texte" name="tarifs" size="30" ><br>
		<label>1ere Demande Renseignements : Horaires</label>
			<input type="texte" name="horaires" size="30" ><br>
		<label>1ere Demande Renseignements : Points de rassemblements</label>
			<input type="texte" name="rassemblement" size="30" ><br>
		<label>Validation Réservation : </label>
			<input type="texte" name="validation" size="30"><p>
		<label>Problèmes Tech Paiement :</label>
			<input type="texte" name="paiement" size="30"><p>
		<label>Problèmes Tech Autres :</label>
			<input type="texte" name="autres" size="30"><p>
		<label>Suivi Demande :</label>
			<input type="texte" name="suivi" size="30"><p>
		<label>Suivi Réservation Client :</label>
			<input type="texte" name="client" size="30"><p>
		<label>Suivi Réservation Gestionnaire :</label>
			<input type="texte" name="suivi_gestionnaire" size="30"><p>
	</fieldset>
			
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	
	<p><a href="deconnexion.php">Déconnexion</a></p>
</form>



</div>
</body>
</html>