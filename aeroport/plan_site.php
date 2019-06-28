<?php
	// Ajout Plan du site (KEMPF)

	session_start();

	require_once('includes/tpl_base.php');
	
	
	// le fil d'ariane
	
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $plan_du_site,
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
					"TITRE_PAGE" => $titre_plan,
					"TITRE" => $plan_du_site,
					"CONTENU" => $text_plan_site
					)
			);
    
    $tpl->parse("aeroport/plan_site.html");

?>
