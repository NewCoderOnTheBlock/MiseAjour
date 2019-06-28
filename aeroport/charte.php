<?php

	session_start();

	require_once('includes/tpl_base.php');
	
	
	// le fil d'ariane
	
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $charte,
							'LIEN' => ''
							)
						);
						
	foreach($tab_ariane as $tab)
	{
		$tpl->setBlock('fil', array(
									'ARIANE' => $tab['ARIANE'],
									'LIEN' => $tab['LIEN']
									)
						);
	}
	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_charte,
					"TITRE" => $charte,
					"CONTENU" => $text_charte
					)
			);
			
    
    $tpl->parse("aeroport/charte.html");

?>
