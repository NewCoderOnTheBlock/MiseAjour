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

<title>Trace PAYPAL</title>
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
//mysql_select_db('alsanavette',$db);


// prendre la liste des champs 
$sql= "SELECT civilite,nom,prenom,e_mail,telephone,portable,n_voie,type_voie,nom_voie,code_postal,ville,typetrajet,depart,destination,d_depart,h_depart,d_retour,h_retour,rassemblement,nb_personnes,demande,date,heure,vol,reservation  FROM prov_reserv ORDER BY reservation desc";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne = mysql_fetch_array($result)) 
{
    echo "<h1>Trace PAYPAL</h1>";
	echo "<table>\n";
    echo "<thead><th>ID</th><th>Civilite</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th><th>Portable</th><th>Nvoie</th><th>TypeVoie</th><th>NomVoie</th><th>CP</th><th>Ville</th><th>Trajet</th><th>Depart</th><th>Destination</th><th>DateDep</th><th>HeureDep</th><th>DateRet</th><th>HeureRet</th><th>Rassemblement</th><th>Personnes</th><th>Demande</th><th>Date</th><th>Heure</th><th>Vol</th></thead>\n";
	do 
	{
		echo"<tr><td>$ligne[24]</td><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td><td>$ligne[3]</td><td>$ligne[4]</td><td>$ligne[5]</td><td>$ligne[6]</td><td>$ligne[7]</td><td>$ligne[8]</td><td>$ligne[9]</td><td>$ligne[10]</td><td>$ligne[11]</td><td>$ligne[12]</td><td>$ligne[13]</td><td>$ligne[14]</td><td>$ligne[15]</td><td>$ligne[16]</td><td>$ligne[17]</td><td>$ligne[18]</td><td>$ligne[19]</td><td>$ligne[20]</td><td>$ligne[21]</td><td>$ligne[22]</td><td>$ligne[23]</td></tr>";
	} 
    while ($ligne = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>Trace PAYPAL</h1>";
echo "Désolé, pas d'enregistrement !";   
}

mysql_close();

?>
</div>
	
</div>

</body>

</html>
