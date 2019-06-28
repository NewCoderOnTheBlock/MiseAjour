<?php
	session_start();
	
	require_once('includes/tpl_base.php');
	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_tarifs,
					"TITRE_TARIF" => $lang_titre_fiche_tarif,
					"TITRE_RASSEMBLEMENT" => $lang_titre_pt_rassemblement,
					"TITRE_RASSEMBLEMENT_AEROPORT" => $lang_point_rass_aeroport,
					"TITRE_INFO_COMPL" => $lang_titre_info_compl,
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
					"EXPLI_PT_RASSEMBLEMENT" => $lang_points_rassemblement_fiche,
					"EXPLI_INFO_COMPL" => $lang_fiche_info_compl,
					"TARIF" => $tarif,
					"EXPLI_FORFAIT_MIN_1" => $lang_fiche_part_1,
					"EXPLI_FORFAIT_MIN_2" => $lang_fiche_part_2,
					"DOMICILE" => $domicile_obligatoire
					)
			);
			
	$leTarif = get_tarif($_GET['tarif']);
	
	$tpl->set(array(
			
			"ID_TARIF" => $leTarif['id_lieu'],
			"NOM_TARIF" => $leTarif['nom'],
			"FORFAIT_TARIF" => $leTarif['prix_forfait'],
			"PRIX_PAR_PERS_TARIF" => $leTarif['prix_forfait'] / $leTarif['nb_personne'],
			"PERSONNE_TARIF" => $leTarif['nb_personne'],
			"DUREE_TARIF" => gmdate('H\hi\m', $leTarif['duree']),
			"LIBELLE_SORTIE" => $leTarif['libelle_sortie_'.$_SESSION["lang"].''],
			"PHOTO_SORTIE" => $leTarif['photo_sortie'],
			"PLAN_SORTIE" => $leTarif['plan_sortie'],
			"LIEN_PLAN_SORTIE" => $leTarif['lien_plan_sortie']
			
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
    
    $tpl->parse("aeroport/fiche_tarif.html");


?>
