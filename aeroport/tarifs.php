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
	
	if (isset($_GET['id']))
	{
		$id = htmlspecialchars(intval($_GET['id']));
		$t = get_tarif($id);
		if (empty($t))
		{
			$id = 0;
		}
	}
	else
	{
		$id = 0;
	}
	

	$avt = 0;
	foreach(get_tarifs() as $tab)
	{
		/*
			Ajout KEMPF :
			
			Particularité Entzheim
		*/
		if ($id == 0 && $tab['ID'] == 1 || $tab['ID'] == $id)
		{
			$selectionne = "bloc_tarif_selectionne";
			$display = "block";
		}
		else
		{
			$selectionne = "";
			$display = "none";
		}
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
											"PERSONNE_AVT" => $avt,
											"SELECTIONNE" => $selectionne,
											"DISPLAY" => $display
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
											"PERSONNE_AVT" => $avt,
											"SELECTIONNE" => $selectionne,
											"DISPLAY" => $display
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
					"EXPLI_REMBOURSEMENT" => $remboursement_forfait,
					"A_PARTIR_DE" => $lang_fiche_a_partir_de,
					"TARIF_BASE" => $tarif_base,
					"PAR_PASSAGER" => $par_passager,
					"INFOS_PRATIQUES" => $infos_pratiques,
					"TARIF" => $tarif_s,
					"TXT_FORFAIT_MINI" => $txt_forfait_mini,
					"OPTIONS" => $options,
					"TXT_PRISE_EN_CHARGE" => $txt_prise_en_charge,
					"HORS" => $hors,
					"TXT_HORAIRES_DEMANDE" => $txt_horaires_demande,
					"LIEN_HORAIRES_PETIT" => $lien_horaires,
					"SERVICES" => $services,
					"TXT_SERVICE_NUIT" => $txt_service_nuit,
					"TXT_DERNIERE_MINUTE_72" => $txt_derniere_minute_72,
					"TXT_DERNIERE_MINUTE_24" => $txt_derniere_minute_24,
					"TXT_SERVICE_ATTENTE" => $txt_service_attente,
					"TRAJET_ALLER_SIMPLE" => $prix_aller_simple,
					"A_PARTIR_DE_STRASBOURG" => $a_partir_de_strasbourg,
					"EXPLI_FORFAIT_MIN_1" => $lang_fiche_part_1,
					"EXPLI_FORFAIT_MIN_2" => $lang_fiche_part_2,
					"INFOS_VOLS" => $infos_vols,
					"LIEU_RASSEMBLEMENT" => $lang_titre_pt_rassemblement,
					"INFO_PAGE" => "tarifs-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php"
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
    
    $tpl->parse("aeroport/tarifs.html");


?>
