<?php

	session_start();
	
	if(!$_SESSION['logger'])
	{
		header('Location: client.html');
		exit();
	}
	
	require_once('../includes/tpl_base.php');
	
	// Ajout du client en tant que client fidele
		devenir_fidele($_SESSION['client']['id_client']);
		$_SESSION['client']['est_fidele'] = est_fidele($_SESSION['client']['id_client']);
		$_SESSION['client']['points_fidelite'] = get_mes_points_fidelite($_SESSION['client']['id_client']);
	//
		
	$tpl->set(array(
					"TITRE_PAGE" => $titre_fidelite,
					"TITRE_FIDELITE" => $titre_fidelite,
					"TITRE_ADHESION" => $lang_adhesion_reussie,
					"EXPLICATION" => $lang_texte_adhesion_reussie
					)
			 );

			 
	$tpl->parse("aeroport/client/adhesion-fidelite.html");

?>