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

<title>stats vehicule et chauffeur</title>
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
<?

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('navette',$db);


// prendre la liste des champs 
$sql= "SELECT * FROM navette WHERE vehicule = 'Nissan1' ORDER BY kmsA desc";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>VEHICULE NISSAN1</h1>";
	echo "<table>\n";
    echo "<thead><th>ID</th><th>Date</th><th>Conducteur</th><th>Service</th><th>Navette</th><th>Remarques</th><th>Groupes</th><th>Passagers aller</th><th>Passagers retour</th><th>Payé</th><th>Départ</th><th>Arrivée</th><th>Durée</th><th>Domicile</th><th>KmsD</th><th>KmsA</th><th>Kms</th><th>EssenceD</th><th>EssenceA</th><th>Payé Essence</th><th>Lavage EXT</th><th>Lavage INT</th><th>Unités</th></thead>\n";
	do 
	{
		$mois = substr($ligne[2], 5, 2);
		$jour = substr($ligne[2], 8, 2);
		$an = substr($ligne[2],0,4);
		$date = $jour."-".$mois."-".$an;
		
        echo"<tr><td>$ligne[0]</td><td>$date</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$ligne[6]</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$ligne[10]</td><td>$ligne[11]</td><td>$ligne[12]</td><td>$ligne[13]</td><td>$ligne[14]</td><td>$ligne[15]</td><td>$ligne[16]</td><td>$ligne[17]</td><td>$ligne[18]</td><td>$ligne[19]</td><td>$ligne[20]</td><td>$ligne[21]</td><td>$ligne[22]</td><td>$ligne[23]</td>";
		echo "<td><b>";
		echo "</a></b></td>";
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>VEHICULE NISSAN1</h1>";
echo "Désolé, pas d'enregistrement !";   
}

// prendre la liste des champs 
$sql= "SELECT * FROM navette WHERE vehicule = 'Renault1' ORDER BY kmsA desc";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>VEHICULE RENAULT1</h1>";
	echo "<table>\n";
    echo "<thead><th>ID</th><th>Date</th><th>Conducteur</th><th>Service</th><th>Navette</th><th>Remarques</th><th>Groupes</th><th>Passagers aller</th><th>Passagers retour</th><th>Payé</th><th>Départ</th><th>Arrivée</th><th>Durée</th><th>Domicile</th><th>KmsD</th><th>KmsA</th><th>Kms</th><th>EssenceD</th><th>EssenceA</th><th>Payé Essence</th><th>Lavage EXT</th><th>Lavage INT</th><th>Unités</th></thead>\n";
	do 
	{
        echo"<tr><td>$ligne[0]</td><td>$ligne[2]</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$ligne[6]</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$ligne[10]</td><td>$ligne[11]</td><td>$ligne[12]</td><td>$ligne[13]</td><td>$ligne[14]</td><td>$ligne[15]</td><td>$ligne[16]</td><td>$ligne[17]</td><td>$ligne[18]</td><td>$ligne[19]</td><td>$ligne[20]</td><td>$ligne[21]</td><td>$ligne[22]</td><td>$ligne[23]</td>";
		echo "<td><b>";
		echo "</a></b></td>";
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>VEHICULE RENAULT1</h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
