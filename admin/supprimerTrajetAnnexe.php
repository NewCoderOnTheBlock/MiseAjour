<?php
/*
	KEMPF : 
	Gestion de la suppression d'une navette d'un service annexe
*/
include("verifAuth.php");
include("connection.php");

$idTrajet = $_POST['id_trajet'];
$valide = !empty($_POST['valide']) ? $_POST['valide'] : 0;

if (!empty($idTrajet)){

	$query_annexe = "	DELETE FROM europa_ligne_reserv
						WHERE code_trajet = '".$idTrajet."'";
			
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
	
	$query_annexe = "	DELETE FROM europa_trajet
						WHERE id_trajet NOT IN (	SELECT code_trajet 
													FROM europa_ligne_reserv)";
			
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
	
	$query_annexe = "	DELETE FROM europa_reservation
						WHERE id_reservation NOT IN (	SELECT code_reserv 
														FROM europa_ligne_reserv)";
			
	$result_annexe = mysql_query($query_annexe) or die (mysql_error());
	
	/* Suppression dans les agendas */
	
	if ($valide == 1){
	
		$query_annexe = "	DELETE FROM agenda_agenda_concerne
							WHERE aco_age_id = (	SELECT age_id
													FROM agenda_agenda
													WHERE id_trajet = '".$idTrajet."')
							LIMIT 1";
				
		$result_annexe = mysql_query($query_annexe) or die (mysql_error());
		
		$query_annexe = "	DELETE FROM agenda_agenda
							WHERE id_trajet = '".$idTrajet."'
							LIMIT 1";
				
		$result_annexe = mysql_query($query_annexe) or die (mysql_error());
		
	}

}

header("Location: index.php?p=1&action=1");
	
?>