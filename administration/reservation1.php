<?php

$civilite = $_POST['civilite'];

$nom = $_POST['nom'];
$nom = strtoupper($nom);
$prenom = $_POST['prenom'];
$prenom = strtolower($prenom);
$e_mail = $_POST['e_mail'];
$telephone = $_POST['telephone'];
$portable = $_POST['portable'];
$paiement = $_POST['paiement']; 
$montant = $_POST['mnt'];

$n_voie = $_POST['n_voie'];
$type_voie = $_POST['type_voie'];
$nom_voie = $_POST['nom_voie'];
$code_postal = $_POST['code_postal'];
$ville = $_POST['ville'];

$typetrajet = $_POST['typetrajet'];	
$depart = $_POST['depart']; 
$destination = $_POST['destination'];

$h_dep = $_POST['h_dep'];
$min_dep = $_POST['min_dep'];
$h_depart = $h_dep.':'.$min_dep;

$j_dep = $_POST['j_dep'];
$m_dep = $_POST['m_dep'];
$a_dep = $_POST['a_dep'];
$d_depart = $a_dep.'-'.$m_dep.'-'.$j_dep;

$h_ret = $_POST['h_ret'];
$min_ret = $_POST['min_ret'];
$h_retour = $h_ret.':'.$min_ret;

$j_ret = $_POST['j_ret'];
$m_ret = $_POST['m_ret'];
$a_ret = $_POST['a_ret'];
$d_retour = $a_ret.'-'.$m_ret.'-'.$j_ret;

$rassemblement = $_POST['rassemblement'];
$nb_remise = $_POST['nb_remise'];	
$nb_personnes = $_POST['nb_personnes'];
$demande = $_POST['demande']; 

$jour = date("j");
$mois = date("m");
$annee = date("Y");
$date = $annee."-".$mois."-".$jour;
$heure = date('H:i');


$db = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
mysql_select_db('db206617947',$db);
//$db = mysql_connect('localhost', 'root', '');
//mysql_select_db('navette',$db);

$sql = "INSERT INTO admin_reserv (civilite , nom , prenom , e_mail , telephone , portable, n_voie , type_voie , nom_voie , code_postal , ville , typetrajet , depart , destination , h_depart , d_depart , h_retour , d_retour , rassemblement , nb_personnes , paiement ,montant,demande , date , heure) VALUES ('$civilite' , '$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie' , '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' , '$typetrajet' , '$depart' , '$destination' , '$h_depart' , '$d_depart' , '$h_retour' , '$d_retour' , '$rassemblement' , '$nb_personnes' , '$paiement', '$montant' ,'$demande' , '$date' , '$heure')"; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if ($typetrajet=='A-R')
{
	$sql = "INSERT INTO admin_reserv (civilite , nom , prenom , e_mail , telephone , portable, n_voie , type_voie , nom_voie , code_postal , ville , typetrajet , depart , destination , h_depart , d_depart , h_retour , d_retour , rassemblement , nb_personnes , paiement ,montant,demande , date , heure) VALUES ('$civilite' , '$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie' , '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' , '$typetrajet' , '$destination' , '$depart' , '$h_retour' , '$d_retour' , '$h_depart' , '$d_depart' , '$rassemblement' , '$nb_personnes' , '$paiement' , '$montant', '$demande' , '$date' , '$heure')"; 
	
mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}

$sql = "INSERT INTO vue_globale (civilite , nom , prenom , e_mail , telephone , portable, n_voie , type_voie , nom_voie , code_postal , ville , typetrajet , depart , destination , d_depart , h_depart , d_retour , h_retour , rassemblement , nb_personnes , paiement ,montant,demande , date) VALUES ('$civilite' , '$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie' , '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' , '$typetrajet' , '$depart' , '$destination' , '$d_depart' , '$h_depart' , '$d_retour' , '$h_retour' , '$rassemblement' , '$nb_personnes' , '$paiement' , '$montant', '$demande' , '$date')"; 

mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if ($typetrajet=='A-R')
{
	$sql = "INSERT INTO vue_globale (civilite , nom , prenom , e_mail , telephone , portable, n_voie , type_voie , nom_voie , code_postal , ville , typetrajet , depart , destination , d_depart , h_depart , d_retour , h_retour , rassemblement , nb_personnes , paiement ,montant,demande , date) VALUES ('$civilite' , '$nom' , '$prenom' , '$e_mail' , '$telephone' , '$portable', '$n_voie' , '$type_voie' , '$nom_voie' , '$code_postal' , '$ville' , '$typetrajet' , '$destination' , '$depart' , '$d_retour' , '$h_retour' , '$d_depart' , '$h_depart' , '$rassemblement' , '$nb_personnes' , '$paiement' , '$montant', '$demande' , '$date')"; 
	
mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
}
mysql_close();

session_destroy();

include ("accueil.php");
 
?>

