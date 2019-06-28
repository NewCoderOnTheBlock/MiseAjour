<?php
	session_start();
		
	require_once('../includes/tpl_base.php');

	// le fil d'ariane
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $ariane_reserver,
							'LIEN' => 'reserver.html'
							),
						array(
							'ARIANE' => $ariane_fin_reservation,
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
					"TITRE_PAGE" => $titre_fin_paiement,
					"TITRE" => $fin_paiement,
					"FIN_RES" => $fin_res,
					"REVENIR_ACCUEIL" => $fin_res_accueil,
                    "SONDAGE" => $lien_sondage
					)
			  );

	$tpl->parse("aeroport/reservation/paiement.html");
	
	


?>
