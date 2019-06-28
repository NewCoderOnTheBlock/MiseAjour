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

<title>infos r&eacute;servations</title>
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
$sql= "SELECT reservation.nb_places, reservation.demande_particuliere,reservation.infos_vol, trajet.depart , trajet.nom as nom1, client.nom , reservation.point_rassemblement, reservation.date, reservation.montant FROM client,reservation,trajet where reservation.idtrajet=trajet.idtrajet and client.idclient=reservation.idclient and trajet.depart >= '".date('Y-m-d')."' order by trajet.depart ";

$result = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
//prendre chaque rangée

if ($ligne1 = mysql_fetch_array($result)) 
{
    echo "<h1>R&eacute;servations internet</h1>";
	echo "<table>\n";
    echo "<thead><th>Date</th><th>Heure</th><th>Personnes</th><th>Trajet</th><th>Rassemblement</th><th>Infos vol</th><th>Demande particulière</th><th>Montant</th><th>Date paiement</th><th>Nom</th></thead>\n";
	do 
	{
		$date=substr($ligne1[3],8,2).'/'.substr($ligne1[3],5,2);
		$heure=substr($ligne1[3],11,5);
		$ID1=$ligne1["nom"];
		echo"<tr><td>$date</td><td>$heure</td><td>$ligne1[0]</td><td>$ligne1[4]</td><td>$ligne1[6]</td><td>$ligne1[2]</td><td>$ligne1[1]</td><td>$ligne1[8]</td><td>$ligne1[7]</td>";
		echo "<td><b>";
		?>
		<a href="clients.php?ID=<?echo $ID1?>"  target=_BLANK><? echo $ID1;?></a>
		<?
		echo "</a></b></td>";		  
 	} 
    while ($ligne1 = mysql_fetch_array($result));
    echo "</table>\n";
} 
else  
{
echo "<h1>R&eacute;servations internet</h1>";
echo "Désolé, pas d'enregistrement !";   
}

$mysql_result2 = mysql_query("SELECT d_depart,h_depart,nb_personnes,depart,destination,rassemblement,demande,paiement, montant,nom,date FROM admin_reserv where d_depart >= '".date('Y-m-d')."' order by d_depart,h_depart");

//prendre chaque rangée

if ($ligne2 = mysql_fetch_array($mysql_result2)) 
{
	echo "<br>";
	echo "<h1>R&eacute;servations saisies</h1>";
    echo "<table>\n";
    echo "<thead><th>Date</th><th>Heure</th><th>Personnes</th><th>Départ</th><th>Arrivée</th><th>Rassemblement</th><th>Demande</th><th>Paiement</th><th>Montant</th><th>Date paiement</th><th>Nom</th></thead>\n";
    do 
	{
		$date1=substr($ligne2[0],8,2).'/'.substr($ligne2[0],5,2);
		$heure1=substr($ligne2[1],0,5);
		$ID2=$ligne2["nom"];
		echo"<tr><td>$date1</td><td>$heure1</td><td>$ligne2[2]</td><td>$ligne2[3]</td><td>$ligne2[4]</td><td>$ligne2[5]</td><td>$ligne2[6]</td><td>$ligne2[7]</td><td>$ligne2[8]</td><td>$ligne2[10]</td>";
		echo "<td><b>";
		?>
		<a href="clients1.php?ID=<?echo $ID2?>"  target=_BLANK><? echo $ID2;?></a>
		<?
		echo "</a></b></td>";
	} 
    while ($ligne2 = mysql_fetch_array($mysql_result2));
    echo "</table>\n";
} 
else  
{
echo "<h1>R&eacute;servations saisies</h1>";
echo "Désolé, pas d'enregistrement !";   
}

echo "<br>";

/*
$mysql_result3 = mysql_query("SELECT distinct nom,prenom,adresse,ville,mail,telephone,portable FROM client ORDER BY nom");
//prendre chaque rangée

if ($ligne3 = mysql_fetch_array($mysql_result3)) 
{
    echo "<h1>clients internet</h1>";
	echo "<table>\n";
    echo "<thead><th>nom</th><th>prenom</th><th>adresse</th><th>ville</th><th>mail</th><th>telephone</th><th>portable</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",  $ligne3["nom"],  $ligne3["prenom"] , $ligne3["adresse"] ,$ligne3["ville"], $ligne3["mail"], $ligne3["telephone"], $ligne3["portable"]);
	} 
    while ($ligne3 = mysql_fetch_array($mysql_result3));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}

$mysql_result4 = mysql_query("SELECT distinct nom,prenom,n_voie,type_voie,nom_voie,ville,e_mail,telephone,portable FROM admin_reserv ORDER BY nom");
//prendre chaque rangée

if ($ligne4 = mysql_fetch_array($mysql_result4)) 
{
    echo "<h1>clients saisis</h1>";
	echo "<table>\n";
    echo "<thead><th>nom</th><th>prenom</th><th>adresse</th><th>ville</th><th>mail</th><th>telephone</th><th>portable</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",  $ligne4["nom"],  $ligne4["prenom"] , $ligne4["n_voie"].' '.$ligne4["type_voie"].' '.$ligne4["nom_voie"] ,$ligne4["ville"], $ligne4["e_mail"], $ligne4["telephone"], $ligne4["portable"]);
	} 
    while ($ligne4 = mysql_fetch_array($mysql_result4));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}
*/
mysql_close();

?>
</div>
	
</div>


	

</body>

</html>
