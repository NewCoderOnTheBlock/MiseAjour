<?php
	include("verifAuth.php");

	include("connection.php");
	// Chargement des fonctions 
		
		
	// Le trajet Aller
	$query = "	INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet)
					VALUES (
						'ALLER',
						'2012-02-29 10:00:00',
						'',
						'0',
						'ROPPENHEIM'
					)";
					
	$result = mysql_query($query) or die (mysql_error());
	
	// Le trajet Retour
	$query = "	INSERT INTO europa_trajet(type_trajet, date_trajet, adresse, nb_pers, service_trajet)
					VALUES (
						'RETOUR',
						'2012-02-29 15:00:00',
						'',
						'0',
						'ROPPENHEIM'
					)";
					
	$result = mysql_query($query) or die (mysql_error());
?>