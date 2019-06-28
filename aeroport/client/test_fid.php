<?php
	require_once('../includes/tpl_base.php');
	$id_client = 67;
	
	echo "Nb Points : ".get_mes_points_fidelite($id_client)."<br /><br />";
	echo "Ajout de 50<br /><br />";
	ajouter_points_fidelite($id_client, 50);
	echo "Nb Points : ".get_mes_points_fidelite($id_client)."<br /><br />";
	echo "Suppression de 20<br /><br />";
	retirer_points_fidelite($id_client, 500);
	echo "Nb Points : ".get_mes_points_fidelite($id_client)."<br /><br />";
?>