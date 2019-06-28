<?php
/*
 * Nom du fichier : choix-navette_aller.php
 * 
 * 
 * Objectif :Creer le template de la page 3/5
 * Remarques : toutes ces variables indiquent le passager qui n'est pas celui qui reserve 
 * 
		"TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE" =>  $titre_a_cocher_si_la_personne_est_autre,
        "TXT_NOM_PASSAGER" =>  $nom_autre_passager,
		"INDICATIF_TEL_AUTRE_PASSAGER" => $indicatif_tel_autre_passager,
		"TEL_PORT_AUTRE_PASSAGER" => $tel_port_autre_passager
 * **/
	session_start();

	require_once('../includes/tpl_base.php');
	require_once('./ressource.php');

	unset($_SESSION['fin_resa']);

	unset($_SESSION['debut_resa']);

    unset($_SESSION['etat_aller']);
    unset($_SESSION['etat_retour']);

    function creationListeIndicatif()
    {
    	$retour = "<select id='lstIndicatifTelephone' name='lstIndicatifTelephone'>";
    	$sql = "select * from aeroport_pays";
    	$res = execution($sql); 
    	while($l = mysql_fetch_array($res))
    	{
    		$retour.= "<option value='".$l['id_pays']."'>".$l['nom_pays']." - ".$l['identifiant_tel']."</option>";
    	}
    	$retour.="</select>";
    	return $retour;
    }
    
    
	if(isset($_GET['res_2_1']) && $_GET['res_2_1'] == "1")
	{
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
								'ARIANE' => $ariane_reservation_navette,
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
		
        $id_lieu_dest = $_SESSION['trajet']['dest'];
		$id_lieu_depart = $_SESSION['trajet']['depart'];

		$nb_pers = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);

		// voir si navette vers la même destination et du même départ le même jour

		$navette_dispo_aller = get_navette_dispo($_SESSION['trajet']['date_depart'], $id_lieu_depart, $id_lieu_dest, $nb_pers);


		$tab_navette_dispo_aller = array();

		$navette_aller = false;
        $navette_meme_heure = false;

		$nom_depart = get_lieu($id_lieu_depart);
		$nom_dest = get_lieu($id_lieu_dest);

		$idd_lieu = ($id_lieu_depart != 100) ? $id_lieu_depart : $id_lieu_dest;
		$prix_personne = get_prix_personne($idd_lieu);


        $tab_date_depart = explode('-', $_SESSION['trajet']['date_depart']);
        $tab_dbl_pt = explode(":", $_SESSION['trajet']['heure_depart']);

		$annee_depart = intval($tab_date_depart[2]);
		$mois_depart = intval($tab_date_depart[1]);
		$jour_depart = intval($tab_date_depart[0]);


		$diff = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, $mois_depart, $jour_depart, $annee_depart) - time();


		$is_der_min = "0";
		$_SESSION['res_der_min'] = false;

        $supplement_res_der_min = 0;


		if($diff <= 3600*72)
		{
			$is_der_min = "1";
            $supplement_res_der_min = get_option("maj_72");

            if($diff < 3600*24)
                $supplement_res_der_min = get_option("maj_24");


			$_SESSION['res_der_min'] = true;

			$tpl->set(array(
							"ATTENTION" => $attention_der_min . get_option(($diff < 3600*24) ? "maj_24" : "maj_72") . $attention_der_min_fin
							)
					 );
		}

        if(get_nb_personne_forfait($idd_lieu) <= ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']))
            $prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
        else
            $prix = get_prix_forfait($idd_lieu);
            

		if($navette_dispo_aller->rowCount() != 0)
		{
			$navette_aller = true;

            $prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);

			while($row = $navette_dispo_aller->fetch())
			{

                $tab_date = explode(' ', $row['date2']);
                $tab_date_depart = explode('/', $tab_date[0]);
                $tab_dbl_pt = explode(":", $tab_date[1]);

                $annee_depart = intval($tab_date_depart[2]);
                $mois_depart = intval($tab_date_depart[1]);
                $jour_depart = intval($tab_date_depart[0]);


                $diff = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, $mois_depart, $jour_depart, $annee_depart) - time();

                $supplement_res_der_min2 = 0;
                if($diff <= 3600*72)
                {
                    $supplement_res_der_min2 = get_option("maj_72");

                    if($diff < 3600*24)
                        $supplement_res_der_min2 = get_option("maj_24");
                }

				array_push($tab_navette_dispo_aller, array('NAVETTE' => array(
																				$nom_depart,
																				$nom_dest,
																				$row['date'],
																				($row['nb_pers'] + $row['nb_enfant']),
																				($prix + $supplement_res_der_min2) . " €"
																				),
															'ID' => $row['id_trajet']
															)
						  );

                // date du trajet pour se rajouter
                $tab_espace = explode(" ", $row['date2']);
                $tab_slash = explode("/", $tab_espace[0]);
                $tab_dbl_pt = explode(":", $tab_espace[1]);

                $date_trajet_rajout = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, intval($tab_slash[1]), intval($tab_slash[0]), intval($tab_slash[2]));

                // date du trajet demandé
                $tab_slash = explode("-", $_SESSION['trajet']['date_depart']);
                $tab_dbl_pt = explode(":", $_SESSION['trajet']['heure_depart']);

                $date_trajet_demande = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, intval($tab_slash[1]), intval($tab_slash[0]), intval($tab_slash[2]));

                if($date_trajet_demande == $date_trajet_rajout)
                    $navette_meme_heure = true;
			}
		}

        if(get_nb_personne_forfait($idd_lieu) <= ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']))
            $prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
        else
            $prix = get_prix_forfait($idd_lieu);

		$navette_dispo_aller->closeCursor();


        $_SESSION['chauffeur_id_aller'] = 0;
		$_SESSION['chauffeur_id_retour'] = 0;
        $_SESSION['id_com_aller'] = 0;

        ressource('aller', 'depart', 'vehicule');
		ressource('aller', 'depart', 'chauffeur');

        $ress_aller = true;

        if($_SESSION['vehicule_id_aller'] == 0 || $_SESSION['chauffeur_id_aller'] == 0)
			$ress_aller = false;


        $type = "";

        if($_SESSION['trajet']['pt_rass_aller'] == 4)
			$type = "DOM";


        $sur_adresse_aller = "";
		if($_SESSION['trajet']['depart'] == 100)
			$sur_adresse_aller = $sur_adresse_prise;
		else
			$sur_adresse_aller = $sur_adresse_depose;



        $tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_aller']));

        $tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);

        if($_SESSION['trajet']['dest'] != 100) // si on part de strasbourg
            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
        else
            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]);

        $tps_rassemblement_retour = 0;


        if($_SESSION['ressource_aller'])
            $tpl->set("NB_PASS_MINI", "1");
        else
            $tpl->set("NB_PASS_MINI", get_nb_personne_forfait(($_SESSION['trajet']['depart'] != 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest']));

        $tab_surcout = array(1, 2);

        if(!$_SESSION['trajet']['bool_depart_fixe'] && (in_array($_SESSION['trajet']['depart'], $tab_surcout) || in_array($_SESSION['trajet']['dest'], $tab_surcout)))
			$supplement_res_der_min += get_option("maj_surcout_demande");

            
        $tpl->set(array(
                    "BTN_CONTINUER" => $btn_etape_suivante,
                    "TITRE_PAGE" => $titre_choix_navette,
                    "TITRE_MON_TRAJET" => $mon_trajet,
                    "IS_DER_MIN" => $is_der_min,
                    "GOOGLE_MAPS" => $_SESSION['google_maps'],
                    "REMBOURSEMENT_FORFAIT" => $remboursement_forfait,
                    "CHOIX_NAVETTE" => $choix_navette,
                    "TAB_HEADER" => get_tab_navette_existant(),
                    "TAB_NAVETTE_DISPO" => $tab_navette_dispo_aller,
                    "NAVETTE_EXISTANT" => $navette_existant_aller,
                    "NAVETTE" => $navette_aller,
                    "BOOL_NAV" => ($navette_aller) ? 1 : 0,
                    "ADDR" => $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . $_SESSION['trajet']['rass_ville_aller'],
                    "TYPE" => $type,
					"SUR_ADRESSE" => $sur_adresse,
					"PB_ADRESSE" => $sur_adresse_aller . $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . $_SESSION['trajet']['rass_ville_aller'],
                    "RETOUR" => $retour,
					"AUCUNE_NAVETTE" => $aucune_navette,
					"NAVETTE_DISPONIBLE" => $navette_disponible,
					"RESS" => $ress_aller,
                    "TXT_PAS_RESSOURCE" => $txt_pas_ressource_aller,
                    "PB_RESSOURCE" => (!$ress_aller) ? "1" : "0",
                    "CODE_POST" => $_SESSION['trajet']['rass_cp_aller'],
                    "LABEL_CHK_FORF_MINI" => $label_chk_forfait_mini . $de . get_prix_forfait($idd_lieu) . " €",
                    "LBL_TARIF_TRAJET" => ($prix + $supplement_res_der_min),
					"EXPLICATION_FORFAIT_MINI" => $explication_forfait_minimum,
					"TXT_PAS_RESSOURCE_FORFAIT" => $txt_pas_ressource_forfait,
                    "BOOL_DEPART_FIXE" => $_SESSION['trajet']['bool_depart_fixe'],
                    "TYPE_TRAJET" => $trajet_type,
					"TRAJET_DEPART" => $trajet_depart,
					"TRAJET_ARRIVE" => $trajet_arrive,
					"INFO_COMPL" => $info_compl,
					"ALLER" => $aller,
                    "DATE_DEPART" => $date,
                    "HEURE_DEPART" => $heure,
                    "ADRESSE_CLIENT" => $adresse_client,
                    "CODE_POST_CLIENT" => $code_post_client,
                    "VILLE_CLIENT" => $ville_client,
                    "INFO_VOL" => $info_vol,
                    "PT_RASSEMBLEMENT" => $pt_rassemblement,
                    "PASSAGER_ADULTE" => $passager_adulte,
                    "PASSAGER_ENFANT" => htmlentities($passager_enfant),
                    "TRAJET" => $_SESSION['trajet']['type_trajet'],
                    "TXT_TYPE_TRAJET" => ($_SESSION['trajet']['type_trajet'] == 1) ? $trajet_aller_simple : $trajet_aller_retour,
                    "TXT_TRAJET_DEPART" => get_lieu($_SESSION['trajet']['depart']),
                    "TXT_TRAJET_ARRIVE" => get_lieu($_SESSION['trajet']['dest']),
                    "TXT_PT_RASS_ALLER" => get_pt_rass($_SESSION['trajet']['pt_rass_aller']),
                    "TXT_RASS_ADRESSE_ALLER" => $_SESSION['trajet']['rass_adresse_aller'],
					"TXT_RASS_CP_ALLER" => $_SESSION['trajet']['rass_cp_aller'],
					"TXT_RASS_VILLE_ALLER" => $_SESSION['trajet']['rass_ville_aller'],
                    "TXT_DATE_DEPART" => $_SESSION['trajet']['date_depart_long'],
                    "TXT_DATE_DEPART_COURT" => str_replace('-', '/', $_SESSION['trajet']['date_depart']),
                    "COMPAGNIE" => $compagnie_vol,
                    "DEST_VOL" => $dest_vol,
                    "HEURE_VOL" => $heure_vol,
                    "COMPAGNIE_INFO_VOL_ALLER" => $_SESSION['trajet']['compagnie_depart_vol'],
                    "DEST_INFO_VOL_ALLER" => $_SESSION['trajet']['provenance_depart_vol'],
                    "HEURE_INFO_VOL_ALLER" => $_SESSION['trajet']['heure_depart_vol'] . "h" . $_SESSION['trajet']['minute_depart_vol'],
                    "TXT_HEURE_DEPART" => str_replace(':', 'h', date('H:i', $tps_rassemblement_aller)),
                    "TXT_PASSAGER_ADULTE_ALLER" => $_SESSION['trajet']['passager_adulte_aller'],
					"TXT_PASSAGER_ENFANT_ALLER" => $_SESSION['trajet']['passager_enfant_aller'],
                    "TXT_INFO_COMPL" => nl2br(wordwrap($_SESSION['trajet']['info_compl'], 100, '<br />', true)),
                    "LABEL_ATTENDRE" => $label_attendre,
                    "EXPLI_ATTENDRE" => $expli_attendre,
                    "CHOIX_1" => $choix . "1",
                    "CHOIX_2" => $choix . (($navette_aller) ? "2" : "1"),
                    "CHOIX_3" => $choix . (($ress_aller && $navette_aller) ? "3" : (($navette_aller && !$ress_aller) || (!$navette_aller && $ress_aller) ? "2" : ((!$navette_aller && !$ress_aller) ? "1" : ""))),
                    "NB_PASS" => $_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller'],
                    "LABEL_NOUVELLE_NAVETTE" => $label_nouvelle_navette,
                    "TXT_PT_RASS_RETOUR" => get_pt_rass($_SESSION['trajet']['pt_rass_retour']),
                    "TXT_RASS_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'],
					"TXT_RASS_CP_RETOUR" => $_SESSION['trajet']['rass_cp_retour'],
					"TXT_RASS_VILLE_RETOUR" => $_SESSION['trajet']['rass_ville_retour'],
                    "TXT_DATE_RETOUR" => $_SESSION['trajet']['date_retour_long'],
                    "COMPAGNIE_INFO_VOL_RETOUR" => $_SESSION['trajet']['compagnie_retour_vol'],
					"DEST_INFO_VOL_RETOUR" => $_SESSION['trajet']['provenance_retour_vol'],
					"HEURE_INFO_VOL_RETOUR" => $_SESSION['trajet']['heure_retour_vol'] . "h" . $_SESSION['trajet']['minute_retour_vol'],
                    "TXT_HEURE_RETOUR" => str_replace(':', 'h', date('H:i', $tps_rassemblement_retour)),
                    "TXT_PASSAGER_ADULTE_RETOUR" => $_SESSION['trajet']['passager_adulte_retour'],
                    "TXT_PASSAGER_ENFANT_RETOUR" => $_SESSION['trajet']['passager_enfant_retour'],
                    "RETOUR" => $retour,
                    "DATE_RETOUR" => $date,
                    "HEURE_RETOUR" => $heure,
                    "MEME_HEURE" => ($navette_meme_heure) ? "1" : "0",
                    "LABEL_INDICATIF_TELEPHONE" => $indicatif_tel_autre_passager,
     				"LABEL_TELEPHONE" => $tel_port_autre_passager,
        			"INDICATIF_TELEPHONE" => creationListeIndicatif(),
        
					"TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE" =>  $titre_a_cocher_si_la_personne_est_autre,
        			"TXT_NOM_PASSAGER" =>  $nom_autre_passager,
					"INDICATIF_TEL_AUTRE_PASSAGER" => $indicatif_tel_autre_passager,
					"TEL_PORT_AUTRE_PASSAGER" => $tel_port_autre_passager
        
                    ));
        
        $tpl->parse("aeroport/reservation/navette_dispo_aller.html");
    }
    else
	{
		header('Location: ../index.html');
		exit();
	}


function execution($req)
{	
	if($_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
	{
		$c = mysql_connect('localhost', 'root', '');
		mysql_select_db('a-n');
	}
	else
	{
		$c = mysql_connect('db922.1and1.fr', 'dbo206617947', 'D5ZEtV4h');
		mysql_select_db('db206617947');
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET CHARACTER SET utf8');
	
	$res = mysql_query($req,$c);
	mysql_close($c);
	return $res;
}
?>
