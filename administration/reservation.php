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

<title>r&eacute;servation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	
	<h1>R&eacute;servation</h1>

	<?php
	  include("menu.php");
	  ?>
<br><br><br><br><br><br><br><br>
<form method="post" action= "reservation2.php">
	<fieldset class="field">
	<legend>Trajet</legend>
		<label>Paiement : </label>&nbsp;
			<select name="paiement">
				<option>CB</option>
				<option>ch&egrave;que</option>
				<option>esp&egrave;ce</option></select>&nbsp;
		<label>Montant :</label>
			<input type="texte" name="mnt" size="4" ONFOCUS='this.value=""'><p>
		<label>Type : </label>
			<input type="radio" name="typetrajet" value="A">Aller simple
			<input type="radio" name="typetrajet" value="A-R">Aller/Retour<p>
		<label>Depart : </label>
			<SELECT NAME="depart">
				<OPTION>Strasbourg</OPTION>
				<OPTION>Francfort-Main</OPTION>
				<OPTION>Francfort-Hahn</OPTION>
				<OPTION>Stuttgart</OPTION>
				<OPTION>Bâle-Mulhouse</OPTION>
				<OPTION>Karlsruhe-Baden</OPTION>
				<OPTION>Zurich</OPTION>
				<OPTION>Service</OPTION>
			</SELECT>&nbsp;
		<label>Destination : </label>	
			<SELECT NAME="destination">
				<OPTION>Strasbourg</OPTION>
				<OPTION>Francfort-Main</OPTION>
				<OPTION>Francfort-Hahn</OPTION>
				<OPTION>Stuttgart</OPTION>
				<OPTION>Bâle-Mulhouse</OPTION>
				<OPTION>Karlsruhe-Baden</OPTION>
				<OPTION>Zurich</OPTION>
				<OPTION>Service</OPTION>
			</SELECT><p>
		<label>Date de départ :</label>
			<input type="texte" name="j_dep" size="2" ONFOCUS='this.value=""' value="JJ">&nbsp;<input type="texte" ONFOCUS='this.value=""' value="MM" name="m_dep" size="2"><input type="texte" name="a_dep" size="4" ONFOCUS='this.value=""' value="AAAA">
		<label>Heure de départ : </label>
			<input type="texte" name="h_dep" size="2" ONFOCUS='this.value=""' value="hh">&nbsp;<input type="texte" ONFOCUS='this.value=""' value="mm" name="min_dep" size="2"><br>
		<label>Date de retour :</label>
			<input type="texte" name="j_ret" size="2" ONFOCUS='this.value=""' value="JJ"><input type="texte" ONFOCUS='this.value=""' value="MM" name="m_ret" size="2"><input type="texte" name="a_ret" size="4" ONFOCUS='this.value=""' value="AAAA">
		<label>Heure de retour : </label> 
			<input type="texte" name="h_ret" size="2" ONFOCUS='this.value=""' value="hh">&nbsp;<input type="texte" ONFOCUS='this.value=""' value="mm" name="min_ret" size="2"><p>
		<label>Points de rassemblement :</label>
			<input type="radio" name="rassemblement" value="palais des droits de l homme" />Palais des droits de l'homme
			<input type="radio" name="rassemblement" value="hotel hilton" />Hotel Hilton
			<input type="radio" name="rassemblement" value="Strasbourg gare" />Gare
			<input type="radio" name="rassemblement" value="Domicile" />Domicile ou Bureau<p>
		<label>Nombre de passagers : </label>
			<input type="texte" name="nb_personnes" size="2"><p>
		<label>Demande particulière :</label>
			<textarea name="demande" rows="3" cols="30" size ="200"></textarea>
	</fieldset>
	<p>
	<fieldset class="field">
		<legend>Client</legend>										
			<label>Civilité : </label>
				<input type="radio" name="civilite" value="M." />M.
				<input type="radio" name="civilite" value="Mlle" />Mlle
				<input type="radio" name="civilite" value="Mme" />Mme
			&nbsp;<label>Nom : </label>&nbsp;
				<input class = "input_res2" type="text" name="nom" size="30" />
			<label>Prénom : </label>
				<input class = "input_res2" type="text" name="prenom" size="30" /><p>
			
			<label>Email :</label>
				<input class = "input_res2" type="text" name="e_mail" size="30" />&nbsp;
			<label>Telephone : </label>
				<input class = "input_res2" type="text" name="telephone" size="10" ONFOCUS='this.value=""' value="XXXXXXXXXX"/>&nbsp;
			<label>Portable : </label>
				<input class = "input_res2" type="text" name="portable" size="10" ONFOCUS='this.value=""' value="XXXXXXXXXX" /><p>
			<label>N° voie : </label>
				<input class = "input_res2" type="text" name="n_voie" size="4" />&nbsp;
			<label>Type de voie : </label>
				<select name="type_voie">
					<option value = "rue">rue</option>
					<option value = "boulevard">boulevard</option>
					<option value = "avenue">avenue</option>
					<option value = "impasse">impasse</option>
					<option value = "chemin">chemin</option>
					<option value = "route">route</option>
				</select><br>
			<label>Nom de voie : </label>
				<input class = "input_res2" type="text" name="nom_voie" size="30" />
			<label>Code postal : </label>&nbsp;
				<input class = "input_res2" type="text" name="code_postal" size="5" />
			<label>Ville : </label>
				<input class = "input_res2" type="text" name="ville" size="30" /><br />
	</fieldset>
		
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	
</form>

</div>
</body>
</html>