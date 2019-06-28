<?php

	session_start();

	require_once('includes/tpl_base.php');
	
	$a = get_tarifs();
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
	
	foreach($a as $tab)
	{
		$tpl->setBlock('duree', array(
										'DEST' => $tab['NOM'],
										'DUREE' => $tab['DUREE']
										)

						);
	}
		
	$max_a = count($a);
	for($i = 0; $i < ($max_a); $i++)
	{
		if ($id == 0)
		{
			$selected = ($i == 0) ? 'bloc_aeroport_selectionne' : '';
			$display = ($i == 0) ? 'block' : 'none';
		}
		else
		{
			$selected = ($a[$i]['ID'] == $id) ? 'bloc_aeroport_selectionne' : '';
			$display = ($a[$i]['ID'] == $id) ? 'block' : 'none';
		}
		$tpl->setBlock('horaires', array('DEST' => $a[$i]['NOM'], 'ID' => $i, 'SELEC' => $selected, 'DISPLAY' => $display, 'MAX_ID' => $max_a, 'TYPE_HOR' => get_type_horaire(date('d-m-Y'), $a[$i]['ID']), 'ID_LIEU' => $a[$i]['ID'],'DUREE' => $a[$i]['DUREE'],'LIEN_HORAIRES_VOLS' => $a[$i]['LIEN_HORAIRES_VOLS']));
		
		$t = get_horaire($a[$i]['ID']);
		for($j = 0; $j < count($t); $j++)
		{
			// 1 = ETE, 2 = HIVER, 0 = RIEN
			$type_h = 0;
			if ($t[$j]['type_horaire'] == "ETE"){
				$type_h = 1;
			}elseif ($t[$j]['type_horaire'] == "HIVER"){
				$type_h = 2;
			}
			
			// Gestion Eté
			if($type_h == 1 || $type_h == 0)
			{
				if ($t[$j]['depart'] <= '12:00:00')
				{
					$tpl->setBlock('horaires.ete_depart_matin', array(
										'DEPART' => substr($t[$j]['depart'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				else
				{
					$tpl->setBlock('horaires.ete_depart_am', array(
										'DEPART' => substr($t[$j]['depart'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				if ($t[$j]['retour'] <= '12:00:00')
				{
					$tpl->setBlock('horaires.ete_retour_matin', array(
										'RETOUR' => substr($t[$j]['retour'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				else
				{		
					$tpl->setBlock('horaires.ete_retour_am', array(
										'RETOUR' => substr($t[$j]['retour'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
			}
			
			// Gestion Hiver
			if($type_h == 2 || $type_h == 0)
			{
				if ($t[$j]['depart'] <= '12:00:00')
				{
					$tpl->setBlock('horaires.hiver_depart_matin', array(
										'DEPART' => substr($t[$j]['depart'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				else
				{
					$tpl->setBlock('horaires.hiver_depart_am', array(
										'DEPART' => substr($t[$j]['depart'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				if ($t[$j]['retour'] <= '12:00:00')
				{
					$tpl->setBlock('horaires.hiver_retour_matin', array(
										'RETOUR' => substr($t[$j]['retour'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
				else
				{
					$tpl->setBlock('horaires.hiver_retour_am', array(
										'RETOUR' => substr($t[$j]['retour'],0,-3),
										'TYPE' => $type_h
										)
								);
				}
			}
		}
	}
	/*
	// Spécifité Entzheim :
	$tpl->setBlock('horaires', array('DEST' => "Entzheim (Strasbourg)", 'ID' => $max_a, 'SELEC' => 'menuDeroulantNonSelection', 'DISPLAY' => 'display:none;', 'MAX_ID' => $max_a));

	// Spécifité Luxembourg :
	$tpl->setBlock('horaires', array('DEST' => "Luxembourg", 'ID' => ($max_a+1), 'SELEC' => 'menuDeroulantNonSelection', 'DISPLAY' => 'display:none;', 'MAX_ID' => $max_a));

	// Spécifité Paris :
	$tpl->setBlock('horaires', array('DEST' => "Paris Orly / Charles de Gaulle", 'ID' => ($max_a+2), 'SELEC' => 'menuDeroulantNonSelection', 'DISPLAY' => 'display:none;', 'MAX_ID' => $max_a));
	*/
	$tpl->set(array(
					"TITRE_PAGE" => $titre_pratique,
					"TITRE" => $presentation_pratique,
					"TITRE_STRAS" => $text_pratique_titre_strasbourg,
					"VOIR_PLUS" => $voir_plus,
					"INFOS_TARIF" => $infos_tarif,
					"HORAIRES_FIXES" => $depart_fixe,
					"ETE" => $lang_ete,
					"HIVER" => $lang_hiver,
					"DEP_STR_GARE" => $dep_str_gare,
					"DEP_AEROPORT" => $dep_aeroport,
					"OPTION" => $option,
					"TXT_OPTION_DEMANDE" => $txt_option_demande,
					"DUREE" => $duree,
					"PT_RASS" => $pt_rass,
					"TXT_RASS_BALE" => $txt_rass_bale,
					"TXT_RASS_BADEN" => $txt_rass_baden,
					"TXT_RASS_STUTTGART" => $txt_rass_stuttgart,
					"TXT_RASS_FRANCFORT_MAIN" => $txt_rass_francfort_main,
					"TXT_RASS_ZURICH" => $txt_rass_zurich,
					"TXT_GOOGLE_MAP" => $txt_google_map,
					"EXPLICATION_ENZTHEIM" => $explication_entzheim,
					"EXPLICATION_AUTRE" => $explication_autre_aeroport,
					"TRAJET_SIMPLE" => $trajet_simple,
					"POINTS_RASS_STRASBOURG" => $points_rass_strasbourg,
					"HORAIRES_DISPONIBLES" => $horaires_disponibles,
					"PTS_RASS" => $pts_rass,
					"TXT_HORAIRES_STRASBOURG" => $txt_horaires_strasbourg,
					"HOTEL_HILTON" => $hotel_hilton,
					"PALAIS_DROITS_HOMMES" => $palais_droits_hommes,
					"TXT_PTS_RASS_STRASBOURG" => $txt_pts_rass_strasbourg,
					"ADRESSE_PALAIS_DROITS_HOMMES" => $adresse_palais_droits_hommes,
					"ADRESSE_HOTEL_HILTON" => $adresse_hotel_hilton,
					"ADRESSE_GARE" => $adresse_gare,
					"HORAIRES_VOLS" => $horaires_vols,
					"TXT_HORAIRES_VOLS" => $txt_horaires_vols,
					"SITE_AEROPORT" => $site_aeroport,
					"INFO_PAGE" => "horaires-baden-karlsruhe-sttutgart-frankfurt-basel-mulhouse-entzheim.php"
					)
			);
    
    $tpl->parse("aeroport/pratique.html");

?>
