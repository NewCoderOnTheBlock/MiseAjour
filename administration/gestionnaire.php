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

<title>gestionnaires</title>
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

// ouverture de la connexion et choix de la BD 
   
$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
//$db = mysql_connect('localhost', 'root', '');
mysql_select_db('db206617947', $connexion);
//mysql_select_db('navette',$db);


// prendre la liste des champs 
$sql= "SELECT * FROM gestion  ORDER BY date,heure desc";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>GESTION</h1>";
	echo "<table>\n";
    echo "<thead><th>Date</th><th>Heure</th><th>Gestionnaire</th><th>Tel</th><th>Internet</th><th>Bureau</th><th>Renseignements tarifs</th><th>Renseignements Horaires</th><th>Renseignements rassemblement</th><th>Validation réservation</th><th>Pb tech paiement</th><th>Pb tech autre</th><th>Suivi demande</th><th>Suivi Réserv Client</th><th>Suivi Réserv Gestionnaire</th></thead>\n";
	do 
	{
		$mois = substr($ligne[14], 5, 2);
		$jour = substr($ligne[14], 8, 2);
		$an = substr($ligne[14],0,4);
		$date = $jour."-".$mois."-".$an;
		
        echo"<tr><td>$date</td><td>$ligne[15]</td><td>$ligne[4]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td><td>$ligne[5]</td><td>$ligne[6]</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$ligne[10]</td><td>$ligne[11]</td><td>$ligne[12]</td><td>$ligne[13]</td>";
		echo "<td><b>";
		echo "</a></b></td>";
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>GESTION</h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
