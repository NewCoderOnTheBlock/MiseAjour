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

<title>historique réservations</title>
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
$sql= "SELECT d_depart,h_depart,nb_personnes,typetrajet,depart,destination,h_vol,n_vol,rassemblement,demande,date,datepaiement, paiement,montant,nom FROM vue_globale  ORDER BY d_depart desc";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>Historique des réservations</h1>";
	echo "<table>\n";
    echo "<thead><th>Date</th><th>Heure</th><th>Personnes</th><th>Trajet</th><th>Départ</th><th>Arrivée</th><th>Heure_Vol</th><th>N° Vol</th><th>Rassemblement</th><th>Demande</th><th>Date demande</th><th>Date paiement</th><th>Paiement</th><th>Montant</th><th>Nom</th></thead>\n";
	do 
	{
		$date=substr($ligne[0],8,2).'/'.substr($ligne[0],5,2);
		$heure=substr($ligne[6],0,5);
		$dated=substr($ligne[10],8,2).'/'.substr($ligne[10],5,2);
		$datep=substr($ligne[11],8,2).'/'.substr($ligne[11],5,2);
		$ID1=$ligne["nom"];
		if ($ligne[11]<>'')
		{
		echo"<tr><td>$date</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$heure</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$dated</td><td>$datep</td><td>$ligne[12]</td><td>$ligne[13]</td>";
		echo "<td><b>";
		?>
		<a href="clients3.php?ID=<?echo $ID1?>"  target=_BLANK><? echo $ID1;?></a>
		<?
		echo "</a></b></td>";
		}
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>Vue d'ensemble des réservations et des demandes</h1>";
echo "Désolé, pas d'enregistrements !";   
}

mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
