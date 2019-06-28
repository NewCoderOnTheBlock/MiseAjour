<?php
	include("../verifAuth.php");
	include_once("../connection.php");
	
	if (isset($_POST['id_trajet'])){
	
		$requete = "DELETE FROM aeroport_trajet
					WHERE id_trajet = ".$_POST['id_trajet']."";
		
		mysql_query($requete) or die(mysql_error());
		
	}
	
	header('Location: ../index.php?p=1&action=1');
?>