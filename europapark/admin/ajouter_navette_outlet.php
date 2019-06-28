<?php
	include("verifAuth.php");
	include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/connexion_bdd.php");
	include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/fonctions.php");
	
	if (empty($_POST['date'])){
		header("Location: index.php?p=4&err=1");
		exit;
	}
	
	include("connection.php");
	
	// Découpage de la date
	
	list($jour, $mois, $annee) = split("-", $_POST['date']);
	
	$heure_aller = $_POST['heure_aller'].":".$_POST['minute_aller'];
	$heure_retour = $_POST['heure_retour'].":".$_POST['minute_retour'];
	
	$date_aller = $annee."-".$mois."-".$jour." ".$heure_aller.":00";
	$date_retour = $annee."-".$mois."-".$jour." ".$heure_retour.":00";
	
	$service = $_POST['service_trajet'];
	
	// Le trajet Aller
	$query = "	INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet)
				VALUES (
					'ALLER',
					'".$date_aller."',
					'',
					'0',
					'".$service."'
				)";
					
	mysql_query($query) or die (mysql_error());
	
	// Le trajet Retour
	$query = "	INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet)
				VALUES (
					'RETOUR',
					'".$date_retour."',
					'',
					'0',
					'".$service."'
				)";
					
	mysql_query($query) or die (mysql_error());
	
	header("Location: index.php?p=4&err=0");
?>