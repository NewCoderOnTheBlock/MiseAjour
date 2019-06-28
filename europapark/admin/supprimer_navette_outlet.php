<?php
	include("verifAuth.php");
	include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/connexion_bdd.php");
	include_once("/homepages/3/d205267944/htdocs/roppenheim/includes/fonctions.php");
	
	if (empty($_POST['id_trajet'])){
		header("Location: index.php?p=4&err=2");
		exit;
	}
	
	include("connection.php");
	
	$id_trajet_aller = intval($_POST['id_trajet']);
	$id_trajet_retour = $id_trajet_aller + 1;
	
	$bdd->exec("DELETE FROM europa_trajet
				WHERE id_trajet = ".$id_trajet_aller."");
				
	$bdd->exec("DELETE FROM europa_trajet
				WHERE id_trajet = ".$id_trajet_retour."");
	
	header("Location: index.php?p=4&err=3");
?>