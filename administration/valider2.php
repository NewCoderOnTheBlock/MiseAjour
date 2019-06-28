<?php

$id = $_POST['id'];
$paiement = $_POST['paiement'];
$montant = $_POST['montant'];

$jour = date("j");
$mois = date("m");
$annee = date("Y");
$date = $annee."-".$mois."-".$jour;

$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "UPDATE vue_globale SET paiement='$paiement' , montant = '$montant', datepaiement= '$date' where reservation = '$id' "; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

mysql_close();

session_destroy();

include ("accueil.php");
 
?>

