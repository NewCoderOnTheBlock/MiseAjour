<?php
include("connection.php");

$idChauffeur = $_POST["id_chauffeur"];
$idTrajet = $_POST["id_trajet"];
$idVehicule = $_POST["id_vehicule"];

if (!empty($idTrajet) && $idChauffeur != 0 && $idVehicule != 6){
	$query = "	UPDATE europa_trajet 
				SET code_chauffeur = '".$idChauffeur."', code_vehicule = '".$idVehicule."' 
				WHERE id_trajet = '".$idTrajet."'";
				
	mysql_query($query)or die(mysql_error());
}
header("Location: index.php?p=1&action=1");
?>