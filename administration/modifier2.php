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

<title>modifier 1 demande</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	<h1>Administration du site www.alsace-navette.com</h1>
	<?php
	  include("menu.php");
	  ?>
	
	<div id="centre">
<br><br><br><br><br><br><br><br>

<?
$id = $_POST['id'];

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('alsanavette',$db);

// prendre la liste des champs 
$sql= "SELECT d_depart,h_depart,nb_personnes,typetrajet,depart,destination,h_vol,n_vol,rassemblement,demande,date,datepaiement,paiement,montant,reservation,civilite, nom ,prenom, e_mail, telephone, portable, n_voie, type_voie, nom_voie, code_postal, ville, pays  FROM vue_globale where reservation = '$id' ";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
?>
    <h1>Modifier 1 Demande</h1>
	<table>
    <thead>
	<th>ID</th><th>Date(respecter le meme format)</th><th>Heure(meme format)</th><th>Personnes</th><th>Trajet</th><th>Départ</th><th>Arrivée</th><th>Heure_Vol</th><th>N° Vol</th>
	<th>Rassemblement</th><th>Demande</th><th>Date demande</th><th>Date paiement</th><th>Paiement</th><th>Montant</th>
	<th>Civilité</th><th>Nom</th><th>Prénom</th><th>E-Mail</th><th>Tel</th><th>Portable</th><th>n_voie</th><th>type_voie</th><th>nom_voie</th>
	<th>CP</th><th>Ville</th><th>Pays</th></thead>
<?
	do 
	{
?>
	<form method="post" action= "modifier3.php">
	<tr>
	<td><input type="texte" name="id" size="10" value='<?=$ligne[14]?>'></td>
	<td><input type="texte" name="date" size="10" value='<?=$ligne[0]?>'></td>
	<td><input type="texte" name="heure" size="5" value='<?=$ligne[1]?>'></td>
	<td><input type="texte" name="personnes" size="2" value='<?=$ligne[2]?>'></td>
	<td><input type="texte" name="trajet" size="20" value='<?=$ligne[3]?>'></td>
	<td><input type="texte" name="depart" size="20" value='<?=$ligne[4]?>'></td>
	<td><input type="texte" name="destination" size="20" value='<?=$ligne[5]?>'></td>
	<td><input type="texte" name="heure_vol" size="5" value='<?=$ligne[6]?>'></td>
	<td><input type="texte" name="n_vol" size="100" value='<?=$ligne[7]?>'></td>
	<td><input type="texte" name="rassemblement" size="30" value='<?=$ligne[8]?>'></td>
	<td><input type="texte" name="demande" size="100" value='<?=$ligne[9]?>'></td>
	<td><input type="texte" name="date_dem" size="10" value='<?=$ligne[10]?>'></td>
	<td><input type="texte" name="date_paiement" size="10" value='<?=$ligne[11]?>'></td>
	<td><input type="texte" name="paiement" size="20" value='<?=$ligne[12]?>'></td>
	<td><input type="texte" name="montant" size="3" value='<?=$ligne[13]?>'></td>
	<td><input type="texte" name="civilite" size="10" value='<?=$ligne[15]?>'></td>
	<td><input type="texte" name="nom" size="20" value='<?=$ligne[16]?>'></td>
	<td><input type="texte" name="prenom" size="20" value='<?=$ligne[17]?>'></td>
	<td><input type="texte" name="email" size="30" value='<?=$ligne[18]?>'></td>
	<td><input type="texte" name="tel" size="30" value='<?=$ligne[19]?>'></td>
	<td><input type="texte" name="portable" size="30" value='<?=$ligne[20]?>'></td>
	<td><input type="texte" name="n_voie" size="10" value='<?=$ligne[21]?>'></td>
	<td><input type="texte" name="type_voie" size="20" value='<?=$ligne[22]?>'></td>
	<td><input type="texte" name="nom_voie" size="20" value='<?=$ligne[23]?>'></td>
	<td><input type="texte" name="cp" size="10" value='<?=$ligne[24]?>'></td>
	<td><input type="texte" name="ville" size="20" value='<?=$ligne[25]?>'></td>
	<td><input type="texte" name="pays" size="20" value='<?=$ligne[26]?>'></td>
	</tr>
	<p align="center"><input type="submit" value="Envoyer" />
	<input type="reset" value="Effacer" /></p>
	</form>
	<?	
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>Modifier 1 Demande</h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
</div>
</body>
</html>
