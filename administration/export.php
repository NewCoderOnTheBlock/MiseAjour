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
	
	<div id="centre">
<?
 //parametres de connexion a la bdd

 $connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947', $connexion);

//Premiere ligne = nom des champs (si on en a besoin)
//$csv_output = "p_nom,p_email";
//$csv_output .= "\n";

//Requete SQL
$mysql_result1 = mysql_query("SELECT lieu.descriptif , trajet.arrivee , trajet.depart , client.nom , reservation.idreservation FROM client LEFT JOIN (reservation LEFT JOIN (trajet LEFT JOIN lieu ON trajet.idlieu=lieu.idlieu) ON reservation.idtrajet=trajet.idtrajet) ON client.idclient=reservation.idclient GROUP BY depart");
//prendre chaque rangée

if ($ligne1 = mysql_fetch_array($mysql_result1)) 
{
    echo "<h1>R&eacute;servations internet</h1>";
	echo "<table>\n";
    echo "<thead><th>depart</th><th>nom</th><th>rassemblement</th><th>idreservation</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",  $ligne1["depart"],  $ligne1["nom"] , $ligne1["descriptif"] ,$ligne1["idreservation"] );
	} 
    while ($ligne1 = mysql_fetch_array($mysql_result1));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}

$mysql_result2 = mysql_query("SELECT * FROM admin_reserv ORDER BY d_depart;");

//prendre chaque rangée

if ($ligne2 = mysql_fetch_array($mysql_result2)) 
{
	echo "<br>";
	echo "<h1>R&eacute;servations saisies</h1>";
    echo "<table>\n";
    echo "<thead><th>nom</th><th>type de trajet</th><th>depart</th><th>destination</th><th>D date</th><th>D heure</th><th>R date</th><th>R heure</th><th>rassemblement</th><th>nombre de personnes</th></thead>\n";
    do 
	{
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",  $ligne2["nom"], $ligne2["typetrajet"], $ligne2["depart"], $ligne2["destination"], $ligne2["d_depart"] , $ligne2["h_depart"], $ligne2["d_retour"] , $ligne2["h_retour"], $ligne2["rassemblement"], $ligne2["nb_personnes"]);
	} 
    while ($ligne2 = mysql_fetch_array($mysql_result2));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}

echo "<br>";

$mysql_result3 = mysql_query("SELECT * FROM client ORDER BY nom");
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

$mysql_result4 = mysql_query("SELECT * FROM admin_reserv ORDER BY nom");
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

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=AddressBook_" . date("Ymd").".csv");
print $csv_output;
exit;
?>

	</div>
</form>

</div>
</body>
</html>