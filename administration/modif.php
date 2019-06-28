<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<title>modifier une commande</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" > 

</head>

<body>

<div id="container">
	<h1>modifier une commande</h1>
	<?php
	  include("menu.php");
	  ?>
	<div id="centre">
		<p align="center">Cliquez sur l'entr&eacute;e &agrave; modifier<p/p>
<?
	$connexion = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947', $connexion);
 
// prendre la liste des champs de la table admin_reserv
$mysql_result1 = mysql_query("SELECT * FROM client");
//prendre chaque rangée

if ($ligne1 = mysql_fetch_array($mysql_result1)) 
{
    echo "<h1>R&eacute;servations internet</h1>";
	echo "<table>\n";
    echo "<thead><th>nom</th><th>modifier</th></thead>\n";
	do 
	{
        printf("<tr><td>%s</td><td>%s</td></tr>\n", $ligne1["nom"], );
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
    echo "<thead><th>Nom</th></thead>\n";
    do 
	{
        printf("<tr><td>%s</td></tr>\n", $ligne2["nom"]);
	} 
    while ($ligne2 = mysql_fetch_array($mysql_result2));
    echo "</table>\n";
} 
else  
{
echo "Désolé, pas d'enregistrement !";   
}

echo "<br>";
mysql_close();

?>



	</div>
</body>
</html>