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
							'ARIANE' => $cgv,
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
					"TITRE_PAGE" => $titre_cgv,
					"TITRE" => $cgv_long,
					"CONTENU_1" => $text_cgv_1,
					"CONTENU_2" => $text_cgv_2
					)
			);
			
    
    $tpl->parse("aeroport/cgv.html");

?>
