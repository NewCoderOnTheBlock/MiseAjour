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
							'ARIANE' => $presentation_tarifs,
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
	

	$avt = 0;
	foreach(get_tarifs() as $tab)
	{
		/*
			Ajout KEMPF :
			
			Particularité Entzheim
		*/
		if ($tab['ID'] == 7)
		{
			$tpl->setBlock('tarifs', array(
											"ID" => $tab['ID'],
											"NOM" => $tab['NOM'],
											"FORFAIT_SIMPLE" => $tab['FORFAIT'] + 10,
											"FORFAIT_DOUBLE" => (($tab['FORFAIT'] + 10) * 2),
											"PERSONNE" => $tab['PERSONNE'],
											"PRIX_PERSONNE_SIMPLE" => round((($tab['FORFAIT'] + 10) / $tab['PERSONNE']), 2),
											"PRIX_PERSONNE_DOUBLE" => (round((($tab['FORFAIT'] + 10) / $tab['PERSONNE']), 2) * 2),
											"PERSONNE_AVT" => $avt
											)
							);
			$avt = $tab['PERSONNE'];

		}
		else
		{
			$tpl->setBlock('tarifs', array(
											"ID" => $tab['ID'],
											"NOM" => $tab['NOM'],
											"FORFAIT_SIMPLE" => $tab['FORFAIT'],
											"FORFAIT_DOUBLE" => ($tab['FORFAIT'] * 2),
											"PERSONNE" => $tab['PERSONNE'],
											"PRIX_PERSONNE_SIMPLE" => round(($tab['FORFAIT'] / $tab['PERSONNE']), 2),
											"PRIX_PERSONNE_DOUBLE" => (round(($tab['FORFAIT'] / $tab['PERSONNE']), 2) * 2),
											"PERSONNE_AVT" => $avt
											)
							);
			$avt = $tab['PERSONNE'];
		}
	}
	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_tarifs,
					"TITRE" => $presentation_tarifs,
					"PAR_PERSONNE" => $par_personne,
					"FORFAIT_MINI" => $forfait_mini,
					"ALLER_SIMPLE" => $trajet_aller_simple,
					"ALLER_RETOUR" => $trajet_aller_retour,
					"AEROPORTS" => $aeroports,
					"NB_PERS_FORFAIT_MINI" => $nb_pers_forfait_mini,
					"TITRE_COMPAGNIE" => $lang_titre_compagnies,
					"CONTENU" => $text_tarifs,
					"EXPLI_TARIF_MIN" => $explication_forfait_minimum,
					"EXPLI_REMBOURSEMENT" => $remboursement_forfait
					)
			);
			
	// Ajout KEMPF : Liste des compagnies
	foreach($lang_liste_compagnies as $tab)
	{
		$tpl->setBlock('liste_compagnies', array(
									'IMAGE' => $tab['IMAGE'],
									'LIEN' => $tab['LIEN'],
									'TEXTE' => $tab['TEXTE']
									)
						);
	}
    
    $tpl->parse("aeroport/tarifs_test.html");


?>
