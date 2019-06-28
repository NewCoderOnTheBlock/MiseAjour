<?php

	session_start();
	
	if(!$_SESSION['logger'])
	{
		header('Location: client.html');
		exit();
	}
	
	require_once('../includes/tpl_base.php');
	
		
	$tpl->set(array(
					"TITRE_PAGE" => $titre_fidelite,
					"TITRE_FIDELITE" => $programme_fidelite,
					"CONDITIONS" => $lang_conditions_fidelite,
					"ACCEPTER_CONDITION" => $lang_jaccepte_conditions_fidelite,
					"EXPLICATION" => $lang_texte_programme_fidelite,
					"SOUSCRIRE" => $lang_souscrire
					)
			 );

			 
	$tpl->parse("aeroport/client/fidelite.html");

?>