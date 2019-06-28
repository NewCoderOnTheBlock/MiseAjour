<?php

$gestionnaire = $_POST['gestionnaire'];
$tarifs = $_POST['tarifs'];	
$horaires = $_POST['horaires'];
$rassemblement = $_POST['rassemblement']; 
$validation = $_POST['validation'];
$paiement = $_POST['paiement'];	
$autres = $_POST['autres'];
$suivi = $_POST['suivi'];
$client = $_POST['client'];	
$suivi_gestionnaire = $_POST['suivi_gestionnaire'];

$jour = date("j");
$mois = date("m");
$annee = date("Y");
$date = $annee."-".$mois."-".$jour;
$heure = date('H:i');


$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "INSERT INTO gestion (internet , gestionnaire , tarifs , horaires , rassemblement , validation, paiement , autres , suivi , client , suivi_gestionnaire, date , heure) 
VALUES ('oui' , '$gestionnaire' , '$tarifs' , '$horaires' , '$rassemblement' , '$validation', '$paiement' , '$autres' , '$suivi' , '$client' , '$suivi_gestionnaire' , '$date' , '$heure')"; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();

session_destroy();

include ("accueil.php");
 
?>

