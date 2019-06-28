<?php
/*
 * Nom du fichier : navettes_disponibles.php
 * 
 * 
 * Objectif : Afficher les navettes disponibles et leur tarif correspondant
 *
 * **/
	session_start();
	require_once('reservation/fonctionConnection.php');
	require_once('includes/tpl_base.php');
	require_once('reservation/ressource.php');

	unset($_SESSION['fin_resa']);
	unset($_SESSION['debut_resa']);
    unset($_SESSION['etat_aller']);
    unset($_SESSION['etat_retour']);

$_SESSION['trajet']['bool_depart_fixe'] = false;
					
	if(isset($_POST['type_trajet'])){
		$_SESSION['client']['mail'] = $_POST['email'];
		$_SESSION['trajet']['type_trajet'] = intval(trim($_POST['type_trajet']));
		$_SESSION['trajet']['depart'] = intval(trim($_POST['lst_trajet_depart']));
		$_SESSION['trajet']['dest'] = intval(trim($_POST['lst_trajet_arrive']));
		$_SESSION['trajet']['retour'] = $_SESSION['trajet']['dest'];
		$_SESSION['client']['mail'] = htmlspecialchars(trim($_POST['email']));
		
			if($_POST['lst_heure_depart'] == '0' && $_POST['lst_fixe_depart'] != "0"){
					$type_fixe = ($_SESSION['trajet']['depart'] == 100) ? "depart" : "retour";
					
					$_SESSION['trajet']['heure_depart'] = get_heure(intval($_POST['lst_fixe_depart']), $type_fixe);
					$_SESSION['trajet']['depart_fixe'] = intval($_POST['lst_fixe_depart']);
					$_SESSION['trajet']['heure_depart_fixe'] = intval($_POST['lst_fixe_depart']);
					$_SESSION['trajet']['bool_depart_fixe'] = true;
			}
			else
			{
					$_SESSION['trajet']['heure_depart'] = trim($_POST['lst_heure_depart']);
					$_SESSION['trajet']['depart_fixe'] = 0;
					$_SESSION['trajet']['heure_depart_fixe'] = 0;
					$_SESSION['trajet']['bool_depart_fixe'] = false;
			}

			if($_SESSION['trajet']['type_trajet'] == 0)
			{

					if($_POST['lst_heure_retour'] == '0' && $_POST['lst_fixe_retour'] != "0")
					{
						$type_fixe = ($_SESSION['trajet']['depart'] != 100) ? "depart" : "retour";

						$_SESSION['trajet']['heure_retour'] = get_heure(intval($_POST['lst_fixe_retour']), $type_fixe);
						$_SESSION['trajet']['retour_fixe'] = intval($_POST['lst_fixe_retour']);
						$_SESSION['trajet']['heure_retour_fixe'] = intval($_POST['lst_fixe_retour']);
						$_SESSION['trajet']['bool_retour_fixe'] = true;
					}
					else{
						$_SESSION['trajet']['heure_retour'] = trim($_POST['lst_heure_retour']);
						$_SESSION['trajet']['retour_fixe'] = 0;
						$_SESSION['trajet']['heure_retour_fixe'] = 0;
						$_SESSION['trajet']['bool_retour_fixe'] = false;
					}
			}
		
			$_SESSION['trajet']['pt_rass_aller'] = intval(trim($_POST['pt_rassemblement_aller']));
			$_SESSION['trajet']['pt_rass_retour'] = intval(trim($_POST['pt_rassemblement_retour']));
			$_SESSION['trajet']['rass_adresse_aller'] = htmlspecialchars(trim($_POST['rass_adresse_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_cp_aller'] = htmlspecialchars(trim($_POST['rass_cp_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_ville_aller'] = htmlspecialchars(trim($_POST['rass_ville_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_pays_aller'] = htmlspecialchars(trim($_POST['rass_pays_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_adresse_retour'] = htmlspecialchars(trim($_POST['rass_adresse_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_cp_retour'] = htmlspecialchars(trim($_POST['rass_cp_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_ville_retour'] = htmlspecialchars(trim($_POST['rass_ville_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_pays_retour'] = htmlspecialchars(trim($_POST['rass_pays_retour']), ENT_COMPAT, "UTF-8");
			$pays_domicile_aller = get_pays2($_SESSION['trajet']['rass_pays_aller']);
			$pays_domicile_retour = get_pays2($_SESSION['trajet']['rass_pays_retour']);
			
			if($_SESSION['trajet']['depart'] == 7 || $_SESSION['trajet']['dest'] == 7){
				$_SESSION['trajet']['pt_rass_aller'] = 4;
				$_SESSION['trajet']['pt_rass_retour'] = 4;
			}
			
			$rass = $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . addslashes($_SESSION['trajet']['rass_ville_aller']);
			
			if($_SESSION['trajet']['pt_rass_aller'] != 4)
			{
				$_SESSION['trajet']['rass_adresse_aller'] = "";
				$_SESSION['trajet']['rass_cp_aller'] = "";
				$_SESSION['trajet']['rass_ville_aller'] = "";
				$_SESSION['trajet']['rass_pays_aller'] = "";
				$pays_domicile_aller = "";
				$_SESSION['trajet']['rass_pays_aller'] = "";
			}
			
			if($_SESSION['trajet']['pt_rass_retour'] != 4)
			{
				$_SESSION['trajet']['rass_adresse_retour'] = "";
				$_SESSION['trajet']['rass_cp_retour'] = "";
				$_SESSION['trajet']['rass_ville_retour'] = "";
				$_SESSION['trajet']['rass_pays_retour'] = "";
				$pays_domicile_retour = "";
				$_SESSION['trajet']['rass_pays_retour'] = "";
			}
			
			
		
			if ($_SESSION['trajet']['depart'] == 100){
				$_SESSION['trajet']['provenance_depart_vol_1'] = "";
				$_SESSION['trajet']['provenance_retour_vol_1'] = "";
				$_SESSION['trajet']['provenance_depart_vol_2'] = get_lieu($_SESSION['trajet']['dest']);
				$_SESSION['trajet']['provenance_retour_vol_2'] = get_lieu($_SESSION['trajet']['dest']);
			}
			else
			{
			$_SESSION['trajet']['provenance_depart_vol_1'] = get_lieu($_SESSION['trajet']['depart']);
			$_SESSION['trajet']['provenance_retour_vol_1'] = get_lieu($_SESSION['trajet']['depart']);
			$_SESSION['trajet']['provenance_retour_vol_2'] = "";
			$_SESSION['trajet']['provenance_depart_vol_2'] = "";
			}
		
		$_SESSION['trajet']['date_depart'] = trim($_POST['jour_depart']);
		$_SESSION['trajet']['date_depart_long'] = trim($_POST['jour_depart_long']);
		$_SESSION['trajet']['date_retour'] = trim($_POST['jour_retour']);
		$_SESSION['trajet']['date_retour_long'] = trim($_POST['jour_retour_long']);
		$_SESSION['trajet']['passager_adulte_aller'] = intval(trim($_POST['lst_passager_adulte_aller']));
		$_SESSION['trajet']['passager_enfant_aller'] = intval(trim($_POST['lst_passager_enfant_aller']));
		
		if($_SESSION['trajet']['type_trajet'] == 0)
		{
			$_SESSION['trajet']['passager_adulte_retour'] = intval(trim($_POST['lst_passager_adulte_aller']));
			$_SESSION['trajet']['passager_enfant_retour'] = intval(trim($_POST['lst_passager_enfant_aller']));
		}
		else
		{
			$_SESSION['trajet']['passager_adulte_retour'] = 0;
			$_SESSION['trajet']['passager_enfant_retour'] = 0;
		}
	}
	
	list($day, $month, $year) = explode('-', $_SESSION['trajet']['date_depart']);
	$date_depart = $year."-".$month."-".$day." ".$_SESSION['trajet']['heure_depart'].":00";
	
	if ($_SESSION['trajet']['type_trajet'] == 0){
		list($day, $month, $year) = explode('-', $_SESSION['trajet']['date_retour']);
		$date_retour = $year."-".$month."-".$day." ".$_SESSION['trajet']['heure_retour'].":00";
	}else{
		$date_retour = "0000-00-00 00:00:00";
	}
	
	
    function creationListeIndicatif()
    {
    	$retour = "<select id='lstIndicatifTelephone' name='lstIndicatifTelephone'>";
    	$sql = "select * from aeroport_pays";
    	$statement=Connectbdd()->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll();
		
		foreach($result as $l){
    	
    		$retour.= "<option value='".$l['id_pays']."'>".$l['nom_pays']." - ".$l['identifiant_tel']."</option>";
    	}
    	$retour.="</select>";
    	return $retour;
    }
    
    

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

/*
*
*		ALLLER
*
*/		
        $id_lieu_dest = $_SESSION['trajet']['dest'];
		$id_lieu_depart = $_SESSION['trajet']['depart'];

		$nb_pers = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
		$nb_pers_aller = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
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
		
		//Initialisation des variables pour le mail
		$prix_horaire_nuit_aller = 0;
		$prix_horaire_demande_aller = 0;
		$prix_dernière_minute_aller = 0;
		$prix_montant_domicile_aller = 0;
		$prix_remise_aller = 0;
		
		$prix_horaire_nuit_retour = 0;
		$prix_horaire_demande_retour = 0;
		$prix_dernière_minute_retour = 0;
		$prix_montant_domicile_retour = 0;
		$prix_remise_retour = 0;


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
		
		// KEMPF : Ajout de la majoration des horaires de nuit
		$montant_maj_nuit = intval(get_option("maj_horaire_nuit"));
		$montant_maj_dom = intval(get_option("maj_dom"));
		
		// Si il existe déjà des navettes, alors on se prépare à parcourir chacune d'elle et les ajouter au "bloc"
		if($navette_dispo_aller->rowCount() != 0){
			$navette_aller = true;
			
			while($row = $navette_dispo_aller->fetchAll())
			{
				// Calcul du prix de la navette
				$prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
			
				// Dernière minute
				$tab_date = explode(' ', $row['date2']);
				$tab_date_depart = explode('/', $tab_date[0]);
				$tab_dbl_pt = explode(":", $tab_date[1]);

				$annee_depart = intval($tab_date_depart[2]);
				$mois_depart = intval($tab_date_depart[1]);
				$jour_depart = intval($tab_date_depart[0]);
				$diff = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, $mois_depart, $jour_depart, $annee_depart) - time();
				
				if($diff <= 3600*72){
					if($diff < 3600*24){
						$prix += intval(get_option("maj_24"));
					}else{
						$prix += intval(get_option("maj_72"));
					}
				}
				
				// Majoration de nuit
				$majoration_nuit = (est_horaire_nuit($tab_dbl_pt[0].":".$tab_dbl_pt[1])) ? $montant_maj_nuit : 0;
				$prix += $majoration_nuit;
				
				// Majoration de prise à domicile
				if($_SESSION['trajet']['pt_rass_aller'] == 4){
					$prix += $montant_maj_dom;	
				}
				
				array_push($tab_navette_dispo_aller, array('NAVETTE' => array(
																			$nom_depart,
																			$nom_dest,
																			$row['date'],
																			($row['nb_pers'] + $row['nb_enfant']),
																			($prix) . " €"
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

		$navette_dispo_aller->closeCursor();

		// Calcul du prix
		$nb_personne_forfait = get_nb_personne_forfait($idd_lieu);
        if($nb_personne_forfait <= ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']))
         {   $prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
            $prix_navette_aller = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);}
        else{
            $prix = get_prix_forfait($idd_lieu);
            $prix_navette_aller = get_prix_forfait($idd_lieu);
		}	
		// KEMPF : Application de la remise pour 8 personnes ( A appliquer sur le tarif de base )
		if (($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']) == 8){
			$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
			$prix -= ($prix*($remise_8_pers_pourcent/100));
			$prix_remise_aller = ($prix*($remise_8_pers_pourcent/100));
		}
		
		// Majoration de prise à domicile
		if($_SESSION['trajet']['pt_rass_aller'] == 4){
			$prix += $montant_maj_dom;	
			$prix_montant_domicile_aller = $montant_maj_dom;
		}
		
		// KEMPF : Ajout de la majoration des horaires de nuit		
		$majoration_nuit = (est_horaire_nuit($_SESSION['trajet']['heure_depart'])) ? $montant_maj_nuit : 0;
		
		$prix += $majoration_nuit;
		$prix_horaire_nuit_aller = $majoration_nuit;
		
		// On ajoute le supplement d'horaires à la demande
		if(isset($_SESSION['trajet']['bool_depart_fixe'])){
			if($_SESSION['trajet']['depart'] == 7 || $_SESSION['trajet']['dest'] == 7)
			{
			$prix += 0;
			}
			else {
			$prix += intval(get_option("maj_surcout_demande"));
			$prix_horaire_demande_aller = intval(get_option("maj_surcout_demande"));
			}
		}
		
		// On ajoute le supplément dernière minute
        $tab_date = explode('-', $_SESSION['trajet']['date_depart']);
		$tab_dbl_pt = explode(":", $_SESSION['trajet']['heure_depart']);
		$diff = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, intval($tab_date[1]), intval($tab_date[0]), intval($tab_date[2])) - time();

		if($diff <= 3600*24){
			$prix += intval(get_option("maj_24"));
			$prix_dernière_minute_aller = intval(get_option("maj_24"));
		}elseif($diff > 3600*24 && $diff <= 3600*72){
			$prix += intval(get_option("maj_72"));
			$prix_dernière_minute_aller = intval(get_option("maj_72"));
		}
		
		// Ajout KEMPF : Option annulation (Doit être posé en dernier !)
	if(isset($_SESSION['trajet']['opt_annulation'])){
		if ($_SESSION['trajet']['opt_annulation'] == 1){
			$prix += ceil($prix * (intval(get_option("maj_annulation")) / 100));
		}
	}
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
		{
            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
			
			if($_SESSION['trajet']['type_trajet'] != 1)
			{
				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);

				$tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
			}
			else
				$tps_rassemblement_retour = 0;
		}
        else
		{
		
			$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);		
		
            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
			
			if($_SESSION['trajet']['type_trajet'] != 1)
			{
				$tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_retour']));

				$tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);

				$tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;
			}
			else
				$tps_rassemblement_retour = 0;
		}


        if($_SESSION['ressource_aller'])
            $tpl->set("NB_PASS_MINI", "1");
        else
            $tpl->set("NB_PASS_MINI", get_nb_personne_forfait(($_SESSION['trajet']['depart'] != 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest']));
		
		$prix_aller = $prix;
		
		$tab = get_tab_navette_existant();
		for($i = 0; $i< count($tab);$i++)
		{
			$tpl->setBlock('tab_header', array(
										'TXT' => $tab[$i],
										'NUM' => $i+1
										)
							);
		}
		if(!isset($pays_domicile_aller)){
				$pays_domicile_aller="";
				$pays_domicile_retour="";
		}
        $tpl->set(array(
                    "BTN_CONTINUER" => $btn_reserver,
					"PAYS_CLIENT" => $pays_client,
					"BTN_ANNULER" => $btn_annuler,
                    "TITRE_PAGE" => $titre_tarif_navette,
                    "TITRE_MON_TRAJET" => $mon_trajet,
                    "IS_DER_MIN" => $is_der_min,
                    "GOOGLE_MAPS" => $_SESSION['google_maps'],
                    "REMBOURSEMENT_FORFAIT" => $remboursement_forfait,
                    "CHOIX_NAVETTE" => $tarif_navette,
                    "TAB_NAVETTE_DISPO_ALLER" => $tab_navette_dispo_aller,
                    "NAVETTE_EXISTANT_ALLER" => $navette_existant_aller,
                    "NAVETTE_ALLER" => $navette_aller,
                    "BOOL_NAV" => ($navette_aller) ? 1 : 0,
                    "ADDR" => $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . $_SESSION['trajet']['rass_ville_aller'],
                    "TYPE" => $type,
					"SUR_ADRESSE" => $sur_adresse,
					"PB_ADRESSE" => $sur_adresse_aller . $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . $_SESSION['trajet']['rass_ville_aller'],
                    "TXT_ADRESSE_ALLER" => $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . $_SESSION['trajet']['rass_ville_aller'],
					"RETOUR" => $retour,
					"AUCUNE_NAVETTE" => $aucune_navette,
					"NAVETTE_DISPONIBLE" => $navette_disponible,
					"RESS" => $ress_aller,
                    "TXT_PAS_RESSOURCE" => $txt_pas_ressource_aller,
                    "PB_RESSOURCE" => (!$ress_aller) ? "1" : "0",
                    "CODE_POST" => $_SESSION['trajet']['rass_cp_aller'],
                    "LABEL_CHK_FORF_MINI" => $label_chk_forfait_mini . $de . get_prix_forfait($idd_lieu) . " €",
                    "LBL_TARIF_TRAJET" => $prix,
					"NB_PERS_FORFAIT" => $nb_personne_forfait,
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
                    "CHOIX_1_ALLER" => $choix . "1 - ".$aller,
                    "CHOIX_2_ALLER" => $choix . (($navette_aller) ? "2 - ".$aller : "1 - ".$aller),
                    "CHOIX_3_ALLER" => $choix . (($ress_aller && $navette_aller) ? "3 - ".$aller : (($navette_aller && !$ress_aller) || (!$navette_aller && $ress_aller) ? "2 - ".$aller : ((!$navette_aller && !$ress_aller) ? "1 - ".$aller : ""))),
                    "NB_PASS" => $_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller'],
                    "LABEL_NOUVELLE_NAVETTE" => $label_nouvelle_navette,
                    "TXT_PT_RASS_RETOUR" => get_pt_rass($_SESSION['trajet']['pt_rass_retour']),
                    "TXT_RASS_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'],
					"TXT_RASS_CP_RETOUR" => $_SESSION['trajet']['rass_cp_retour'],
					"TXT_RASS_VILLE_RETOUR" => $_SESSION['trajet']['rass_ville_retour'],
					/**/
					"TXT_RASS_PAYS_ALLER" => $pays_domicile_aller,
					"TXT_RASS_PAYS_RETOUR" => $pays_domicile_retour,
					/**/
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
                    "MEME_HEURE_ALLER" => ($navette_meme_heure) ? "1" : "0",
                    "LABEL_INDICATIF_TELEPHONE" => $indicatif_tel_autre_passager,
     				"LABEL_TELEPHONE" => $tel_port_autre_passager,
        			"INDICATIF_TELEPHONE" => creationListeIndicatif(),
					"TXT_ACCEPT_CGV" => $accept_cgv,
					"ERREUR" => $_SESSION['erreur_erreur'],
					"CLASS_ERREUR" => $_SESSION['class_erreur'],
					"TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE" => $titre_a_cocher_si_la_personne_est_autre,
					"TXT_NOM_PASSAGER" =>  $nom_autre_passager
                    ));
//	}				

/*
*
*		RETOUR
*
*/
	

		// récupération des infos de l'aller

	if($_SESSION['trajet']['type_trajet'] == 0 )
	{
		if(isset($_POST['navette_dispo'])){
			$new = $_POST['navette_dispo']; // si rajout sur une navette
		}
		else
		{
			$new=0;
		}
		$type_reservation = "RAJOUT";

		if(isset($_POST['accept_forfait_mini']) && $_POST['accept_forfait_mini'] == "on")
			$type_reservation = "FORFAIT";


		// on attend pour l'aller 
		if(isset($_POST['attendre']) && $_POST['attendre'] == "on")
			$type_reservation = "ATTENDRE";

		if(isset($_POST['rb_navette']))
			$_SESSION['etat_aller']['rb_navette'] = $_POST['rb_navette'];
		else
			$_SESSION['etat_aller']['rb_navette'] = "";


		// si on choisi une navette existante

		if($new == 1)
		{
			$t = get_navette(intval($_POST['rb_navette']));

            $_SESSION['etat_aller']['rajout'] = true;
            $_SESSION['etat_aller']['vehicule'] = $t['vehicule'];
            $_SESSION['etat_aller']['chauffeur'] = $t['chauffeur'];
            $_SESSION['etat_aller']['heure_depart'] = $t['date'];
		}
        else
            $_SESSION['etat_aller']['rajout'] = false;

		
        $_SESSION['etat_aller']['type_reservation'] = $type_reservation;


        if($_SESSION['trajet']['pt_rass_aller'] == 4)
		{
            $_SESSION['etat_aller']['distance'] = intval($_POST['distance']);
            $_SESSION['etat_aller']['decalage'] = intval($_POST['decalage']);
		}

        $navette_retour = false;
        $navette_meme_heure = false;
        $tab_navette_dispo_retour = array();

        $id_lieu_dest = $_SESSION['trajet']['dest'];
		$id_lieu_depart = $_SESSION['trajet']['depart'];

        $nom_depart = get_lieu($id_lieu_depart);
		$nom_dest = get_lieu($id_lieu_dest);
        
        $nb_pers = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
		$nb_pers_retour = ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
        $navette_dispo_retour = get_navette_dispo($_SESSION['trajet']['date_retour'], $id_lieu_dest, $id_lieu_depart, $nb_pers);

        $idd_lieu = ($id_lieu_depart != 100) ? $id_lieu_depart : $id_lieu_dest;
		
		$prix_personne = get_prix_personne($idd_lieu);
		
		// On initialise les variables des majorations
		$montant_maj_nuit = intval(get_option("maj_horaire_nuit"));
		$montant_maj_dom = intval(get_option("maj_dom"));

        if($navette_dispo_retour->rowCount() != 0)
        {
            $navette_retour = true;

            while($row = $navette_dispo_retour->fetch())
            {

				$prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
				
				// Ajout de la majoration de nuit
				$tab_date = explode(' ', $row['date2']);
				$tab_dbl_pt = explode(":", $tab_date[1]);
				
				$majoration_nuit = (est_horaire_nuit($tab_dbl_pt[0].":".$tab_dbl_pt[1])) ? $montant_maj_nuit : 0;
		
				$prix += $majoration_nuit;	
				
				// Majoration de prise à domicile
				if($_SESSION['trajet']['pt_rass_retour'] == 4){
					$prix += $montant_maj_dom;	
				}
				
                $idd_lieu = ($row['id_lieu_depart'] != 100) ? $row['id_lieu_depart'] : $row['id_lieu_dest'];

                array_push($tab_navette_dispo_retour, array('NAVETTE' => array(
                                                                                $nom_dest,
                                                                                $nom_depart,
                                                                                $row['date'],
                                                                                ($row['nb_pers'] + $row['nb_enfant']),
                                                                                $prix . " €"
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
                $tab_slash = explode("-", $_SESSION['trajet']['date_retour']);
                $tab_dbl_pt = explode(":", $_SESSION['trajet']['heure_retour']);

                $date_trajet_demande = mktime(intval($tab_dbl_pt[0]), intval($tab_dbl_pt[1]), 0, intval($tab_slash[1]), intval($tab_slash[0]), intval($tab_slash[2]));

                if($date_trajet_demande == $date_trajet_rajout)
                    $navette_meme_heure = true;
            }
        }
		
        $navette_dispo_retour->closeCursor();

		// Calcul du prix
        if($nb_personne_forfait <= ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']))
        {    $prix1 = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
            $prix_navette_retour = $prix_personne * ($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']);
			}
        else
         {   $prix1 = get_prix_forfait($idd_lieu);
            $prix_navette_retour = get_prix_forfait($idd_lieu);
		}
			
		// KEMPF : Application de la remise pour 8 personnes ( A appliquer sur le tarif de base )
		if (($_SESSION['trajet']['passager_adulte_aller'] + $_SESSION['trajet']['passager_enfant_aller']) == 8){
			$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
			$prix1 -= ($prix1*($remise_8_pers_pourcent/100));
			$prix_remise_retour = ($prix1*($remise_8_pers_pourcent/100));
		}
		
		// Majoration de prise à domicile
		if($_SESSION['trajet']['pt_rass_retour'] == 4){
			$prix1 += $montant_maj_dom;	
			$prix_montant_domicile_retour = $montant_maj_dom;
		}
		
		// KEMPF : Ajout de la majoration des horaires de nuit		
		$majoration_nuit = (est_horaire_nuit($_SESSION['trajet']['heure_retour'])) ? $montant_maj_nuit : 0;
		
		$prix1 += $majoration_nuit;
		$prix_horaire_nuit_retour = $majoration_nuit;
		
		// On ajout le surcout pour les horaires à la demande
        if(!$_SESSION['trajet']['bool_retour_fixe']){
			if($_SESSION['trajet']['depart'] == 7 || $_SESSION['trajet']['dest'] == 7)
			{
				$prix1 += 0;
			}
			else {
				$prix1 += get_option("maj_surcout_demande");
				$prix_horaire_demande_retour = get_option("maj_surcout_demande");
			}
		}

        $_SESSION['vehicule_id_aller'] = 0;
		$_SESSION['vehicule_id_retour'] = 0;
        $_SESSION['id_com_retour'] = 0;

        $ress_retour = true;

        ressource('retour', 'retour', 'vehicule');
        ressource('retour', 'retour', 'chauffeur');

        if($_SESSION['vehicule_id_retour'] == 0 || $_SESSION['chauffeur_id_retour'] == 0)
            $ress_retour = false;

        $type = "";

        
        if($_SESSION['trajet']['pt_rass_retour'] == 4)
            $type = "DOM";


        $sur_adresse_retour = "";
        if($_SESSION['trajet']['dest'] == 100)
            $sur_adresse_retour = $sur_adresse_prise;
        else
            $sur_adresse_retour = $sur_adresse_depose;



        if($_SESSION['trajet']['dest'] != 100) // str -> aéroport -> str
        {
            $tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_aller']));

            $tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);

            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;

            $tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);

            $tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
        }
        else // sinon, aéroport -> str -> aéroport
        {
            $tps_pt_rass = get_tps_rass(intval($_SESSION['trajet']['pt_rass_retour']));

            $tab_tps_rass = explode(':', $_SESSION['trajet']['heure_retour']);

            $tps_rassemblement_retour = mktime($tab_tps_rass[0], $tab_tps_rass[1]) + $tps_pt_rass;

            $tab_tps_rass = explode(':', $_SESSION['trajet']['heure_depart']);

            $tps_rassemblement_aller = mktime($tab_tps_rass[0], $tab_tps_rass[1]);
        }


         if($_SESSION['ressource_retour'])
            $tpl->set("NB_PASS_MINI", "1");
        else
            $tpl->set("NB_PASS_MINI", get_nb_personne_forfait(($_SESSION['trajet']['depart'] != 100) ? $_SESSION['trajet']['depart'] : $_SESSION['trajet']['dest']));


		$prix_retour = $prix1;
		if(!isset($_POST['chckPassagerDifferent'])){
			$_POST['chckPassagerDifferent']="";
			$_POST['txtNom']='';
			$table_aeroport_pays['identifiant_tel']=0;
			$_POST['lstIndicatifTelephone']="";
			$_POST['txtPortable']="";
			$titre_a_cocher_si_la_personne_est_autre==0;
		}
        $tpl->set(array(
                    "BTN_CONTINUER" => $btn_reserver,
                    "TITRE_PAGE" => $titre_tarif_navette,
                    "TITRE_MON_TRAJET" => $mon_trajet,
                    "GOOGLE_MAPS" => $_SESSION['google_maps'],
                    "REMBOURSEMENT_FORFAIT" => $remboursement_forfait,
                    "CHOIX_NAVETTE" => $tarif_navette,
                    "TAB_NAVETTE_DISPO" => $tab_navette_dispo_retour,
                    "NAVETTE_EXISTANT" => $navette_existant_retour,
                    "NAVETTE" => $navette_retour,
                    "BOOL_NAV" => ($navette_retour) ? 1 : 0,
                    "ADDR" => $_SESSION['trajet']['rass_adresse_retour'] . ' ' . $_SESSION['trajet']['rass_cp_retour'] . ' ' . $_SESSION['trajet']['rass_ville_retour'],
                    "TYPE" => $type,
					"SUR_ADRESSE" => $sur_adresse,
                    "PB_ADRESSE" => $sur_adresse_retour . $_SESSION['trajet']['rass_adresse_retour'] . ' ' . $_SESSION['trajet']['rass_cp_retour'] . ' ' . $_SESSION['trajet']['rass_ville_retour'],
					"TXT_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'] . ' ' . $_SESSION['trajet']['rass_cp_retour'] . ' ' . $_SESSION['trajet']['rass_ville_retour'],
					"RETOUR" => $retour,
                    "AUCUNE_NAVETTE" => $aucune_navette,
					"NAVETTE_DISPONIBLE" => $navette_disponible,
                    "RESS_RETOUR" => $ress_retour,
                    "TXT_PAS_RESSOURCE" => $txt_pas_ressource_retour,
                    "PB_RESSOURCE" => (!$ress_retour) ? "1" : "0",
                    "CODE_POST" => $_SESSION['trajet']['rass_cp_retour'],
					"NB_PERS_FORFAIT" => $nb_personne_forfait,
                    "LABEL_CHK_FORF_MINI" => $label_chk_forfait_mini . $de . get_prix_forfait($idd_lieu) . " €",
                    "EXPLICATION_FORFAIT_MINI" => $explication_forfait_minimum,
                    "TXT_PAS_RESSOURCE_FORFAIT" => $txt_pas_ressource_forfait,
                    "BOOL_RETOUR_FIXE" => $_SESSION['trajet']['bool_retour_fixe'],
                    "TYPE_TRAJET" => $trajet_type,
                    "TRAJET_DEPART" => $trajet_depart,
                    "TRAJET_ARRIVE" => $trajet_arrive,
                    "INFO_COMPL" => $info_compl,
                    "RETOUR" => $retour,
                    "DATE_RETOUR" => $date,
                    "HEURE_RETOUR" => $heure,
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
                    "TXT_PT_RASS_RETOUR" => get_pt_rass($_SESSION['trajet']['pt_rass_retour']),
                    "TXT_RASS_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'],
					"TXT_RASS_CP_RETOUR" => $_SESSION['trajet']['rass_cp_retour'],
					"TXT_RASS_VILLE_RETOUR" => $_SESSION['trajet']['rass_ville_retour'],
                    "TXT_DATE_RETOUR" => $_SESSION['trajet']['date_retour_long'],
                    "TXT_DATE_RETOUR_COURT" => str_replace('-', '/', $_SESSION['trajet']['date_retour']),
                    "LBL_TARIF_TRAJET1" => $prix1,
					"COMPAGNIE" => $compagnie_vol,
					"DEST_VOL" => $dest_vol,
					"HEURE_VOL" => $heure_vol,
                    "COMPAGNIE_INFO_VOL_RETOUR" => $_SESSION['trajet']['compagnie_retour_vol'],
					"DEST_INFO_VOL_RETOUR" => $_SESSION['trajet']['provenance_retour_vol'],
					"HEURE_INFO_VOL_RETOUR" => $_SESSION['trajet']['heure_retour_vol'] . "h" . $_SESSION['trajet']['minute_retour_vol'],
                    "TXT_HEURE_RETOUR" => str_replace(':', 'h', date('H:i', $tps_rassemblement_retour)),
                    "TXT_PASSAGER_ADULTE_RETOUR" => $_SESSION['trajet']['passager_adulte_retour'],
                    "TXT_PASSAGER_ENFANT_RETOUR" => $_SESSION['trajet']['passager_enfant_retour'],
                    "TXT_INFO_COMPL" => nl2br(wordwrap($_SESSION['trajet']['info_compl'], 100, '<br />', true)),
                    "CHOIX_1_RETOUR" => $choix . "1 - ".$retour,
                    "CHOIX_2_RETOUR" => $choix . (($navette_retour) ? "2 - ".$retour : "1 - ".$retour),
                    "CHOIX_3_RETOUR" => $choix . (($ress_retour && $navette_retour) ? "3 - ".$retour : (($navette_retour && !$ress_retour) || (!$navette_retour && $ress_retour) ? "2 - ".$retour : ((!$navette_retour && !$ress_retour) ? "1 - ".$retour : ""))),
                    "LABEL_CHK_FORF_MINI_RETOUR" => $accept_forfait_mini_retour,
                    "LABEL_NOUVELLE_NAVETTE" => $label_nouvelle_navette,
                    "NB_PASS" => $_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour'],
                    "LABEL_ATTENDRE" => $label_attendre,
                    "EXPLI_ATTENDRE" => $expli_attendre,
                    "ALLER" => $aller,
                    "DATE_DEPART" => $date,
                    "HEURE_DEPART" => $heure,
                    "TXT_PT_RASS_ALLER" => get_pt_rass($_SESSION['trajet']['pt_rass_aller']),
                    "TXT_RASS_ADRESSE_ALLER" => $_SESSION['trajet']['rass_adresse_aller'],
					"TXT_RASS_CP_ALLER" => $_SESSION['trajet']['rass_cp_aller'],
					"TXT_RASS_VILLE_ALLER" => $_SESSION['trajet']['rass_ville_aller'],
                    "TXT_DATE_DEPART" => $_SESSION['trajet']['date_depart_long'],
                    "COMPAGNIE_INFO_VOL_ALLER" => $_SESSION['trajet']['compagnie_depart_vol'],
                    "DEST_INFO_VOL_ALLER" => $_SESSION['trajet']['provenance_depart_vol'],
                    "HEURE_INFO_VOL_ALLER" => $_SESSION['trajet']['heure_depart_vol'] . "h" . $_SESSION['trajet']['minute_depart_vol'],
                    "TXT_HEURE_DEPART" => str_replace(':', 'h', date('H:i', $tps_rassemblement_aller)),
                    "TXT_PASSAGER_ADULTE_ALLER" => $_SESSION['trajet']['passager_adulte_aller'],
					"TXT_PASSAGER_ENFANT_ALLER" => $_SESSION['trajet']['passager_enfant_aller'],
                    "MEME_HEURE" => ($navette_meme_heure) ? "1" : "0",
                    
                    "LABEL_INDICATIF_TELEPHONE" => $indicatif_tel_autre_passager,
     				"LABEL_TELEPHONE" => $tel_port_autre_passager,
					"TXT_ACCEPT_CGV" => $accept_cgv,
					"ERREUR" => $_SESSION['erreur_erreur'],
					"CLASS_ERREUR" => $_SESSION['class_erreur'],
										        			/********
        			 * 
        			 * Ces valeurs sont issues de la page choix-navette_aller.php
        			 * 
        			 ********/
					"VALEUR_CHECK_PASSAGER_DIFFERENT" => $_POST['chckPassagerDifferent'],
        			"VALEUR_NOM_ISSUE_ALLER" => $_POST['txtNom'],
        			"VALEUR_INDICATIF_TEL_AUTRE_PASSAGER_ISSUE_ALLER" =>  $table_aeroport_pays['identifiant_tel'],
        			"VALEUR_ID_PAYS_POUR_TEL" => $_POST['lstIndicatifTelephone'],
        			"VALEUR_PORT_AUTRE_PASSAGER_ISSUE_ALLER" => $_POST['txtPortable'],
					"TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE" => $titre_a_cocher_si_la_personne_est_autre,
					"TXT_NOM_PASSAGER" =>  $nom_autre_passager
                    ));
    } 
		if(!isset($prix_retour)){
			$prix_retour=0;
		}
 		$prix_total = $prix_aller + $prix_retour;
		if($_SESSION['trajet']['type_trajet'] == 0)
		{
			$estSimple = 0;
		}
		else
		{
			$estSimple = 1;
		}

		$req = "INSERT INTO aeroport_demande_annulee (nom, email, id_lieu_depart, id_lieu_dest, date, etape_arret, prix, estSimple, pt_rass_aller, pt_rass_retour) 
				VALUES (
					'" . $_SESSION['client']['civilite']." ".$_SESSION['client']['nom']." ".$_SESSION['client']['prenom'] . "',
					'" . $_SESSION['client']['mail'] . "',
					'" . $_SESSION['trajet']['depart'] . "',
					'" . $_SESSION['trajet']['dest'] . "',
					'" . date("Y-m-d H:i:s") . "',
					'Demande de tarif',
					'" . $prix_total ."',		
					'" . $estSimple ."',
					'" . $_SESSION['trajet']['pt_rass_aller'] ."',
					'" . $_SESSION['trajet']['pt_rass_retour'] ."'
					)";
		$statement=ConnectBDD()->prepare($req);
		$statement->execute();
		$_SESSION['id_demande_annulee'] = Connectbdd()->lastinsertid();;

		$tpl->set(array(
					"ID_DEMANDE_ANNULEE" => $_SESSION['id_demande_annulee'],
                    ));
		
        $tpl->parse("aeroport/navettes_disponibles.html");
		
		require_once(dirname(__FILE__) . "/../libs/Mail.php");		
		$mailer = new Mail();
		
		$langue = $_SESSION['lang'] ;
		if(isset($_POST['email'])){
			$mail_client = $_POST['email'];
		}
		else
		{
			$mail_client="";
			
		}
		switch($langue){            
            
            case 'fr':
 			$content_mail = "<html><head></head><body>Bonjour,<br /><br />Vous avez effectué une recherche d'informations tarifaires de navette sur notre site alsace-navette.com.";
			$content_mail .= "<br />Veuillez trouver ci-dessous le récapitulatif :<br /><br />";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<strong>Aller</strong><br />";
			}
			$content_mail .= "<strong>Départ : </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
			$content_mail .= "<strong>Destination : </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
			$content_mail .= "<strong>Date : </strong>".$_SESSION['trajet']['date_depart_long']."<br />";
			$content_mail .= "<strong>Heure : </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_aller))."<br />";
			$content_mail .= "<strong>Point de prise/dépose sur Strasbourg : </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_aller'])."<br />";
			$content_mail .= "<strong>Nombre de passagers : </strong>".$nb_pers_aller."<br />";
			if($_SESSION['trajet']['pt_rass_aller'] == 4)
			{
				$content_mail .= "<strong>A l'adresse : </strong> ".$_SESSION['trajet']['rass_adresse_aller']." ".
				$_SESSION['trajet']['rass_cp_aller']." ".
				$_SESSION['trajet']['rass_ville_aller']." ".$pays_domicile_aller."<br />";
			}
			
			$content_mail .= "<strong>Prix de la navette : </strong>".$prix_navette_aller." €<br />";
			if($prix_dernière_minute_aller!=0)
			{
			$content_mail .= "<strong>Demande de dernière minute : </strong>".$prix_dernière_minute_aller." € <br />";
			}
			
			if($prix_horaire_demande_aller != 0)
			{
			$content_mail .= "<strong>Horaires à la demande : </strong>".$prix_horaire_demande_aller." € <br />";
			}	
			
			if($prix_horaire_nuit_aller != 0)
			{
			$content_mail .= "<strong>Majoration de nuit : </strong>".$prix_horaire_nuit_aller." € <br />";
			}
			
			if($prix_montant_domicile_aller !=0)
			{
			$content_mail .= "<strong>Prise à domicile : </strong>".$prix_montant_domicile_aller." € <br />";
			}
			
			if($prix_remise_aller != 0)
			{
			$content_mail .= "<strong>Remise 8 personnes : </strong>-".$prix_remise_aller." € <br />";
			}
	$prix_aller = $prix_navette_aller + $prix_dernière_minute_aller + $prix_horaire_demande_aller + $prix_horaire_nuit_aller + $prix_montant_domicile_aller - $prix_remise_aller;
			$content_mail .= "<strong>Prix total du trajet : </strong>".$prix_aller." €";
			$content_mail .= "";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<br /><br /><strong>Retour</strong><br />";
				$content_mail .= "<strong>Départ : </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
				$content_mail .= "<strong>Destination : </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
				$content_mail .= "<strong>Date : </strong>".$_SESSION['trajet']['date_retour_long']."<br />";
				$content_mail .= "<strong>Heure : </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_retour))."<br />";
				$content_mail .= "<strong>Point de prise/dépose sur Strasbourg : </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_retour'])."<br />";
				$content_mail .= "<strong>Nombre de passagers : </strong>".$nb_pers_retour."<br />";
				if($_SESSION['trajet']['pt_rass_retour'] == 4)
				{
					$content_mail .= "<strong>A l'adresse : </strong> ".$_SESSION['trajet']['rass_adresse_retour']." ".
					$_SESSION['trajet']['rass_cp_retour']." ".
					$_SESSION['trajet']['rass_ville_retour']." ".$pays_domicile_retour."<br />";
				}
				
			$content_mail .= "<strong>Prix de la navette : </strong>".$prix_navette_retour." €<br />";
			if($prix_dernière_minute_retour!=0)
			{
			$content_mail .= "<strong>Demande de dernière minute : </strong>".$prix_dernière_minute_retour." € <br />";
			}
			
			if($prix_horaire_demande_retour != 0)
			{
			$content_mail .= "<strong>Horaires à la demande : </strong>".$prix_horaire_demande_retour." € <br />";
			}	
			
			if($prix_horaire_nuit_retour != 0)
			{
			$content_mail .= "<strong>Majoration de nuit : </strong>".$prix_horaire_nuit_retour." € <br />";
			}
			
			if($prix_montant_domicile_retour !=0)
			{
			$content_mail .= "<strong>Prise à domicile : </strong>".$prix_montant_domicile_retour." € <br />";
			}
			if($prix_remise_retour !=0)
			{
			$content_mail .= "<strong>Remise 8 personnes : </strong>-".$prix_remise_retour." € <br />";
			}
	$prix_retour = $prix_navette_retour + $prix_dernière_minute_retour + $prix_horaire_demande_retour + $prix_horaire_nuit_retour + $prix_montant_domicile_retour - $prix_remise_retour;
			$content_mail .= "<strong>Prix total du trajet : </strong>".$prix_retour." €";
			$content_mail .= "";
			
			}
			$content_mail .= "<br /> <br /><strong>Ceci n'est qu'une information tarifaire, sans aucun engagement de votre part.</strong>";
			$content_mail .= "<br /><br />Alsace-navette vous souhaite une agréable journée !<br /><br /><br />";
			$content_mail .= "alsace-navette.com/aeroport <br />2 rue du Coq 67000 Strasbourg <br />OFFICE : +33 (0) 388 222 271 <br/>URGENCE : +33 (0) 627 181 252 <br />info@alsace-navette.com</body></html>";
    		break;
			
			case 'en':
			 $content_mail = "<html><head></head><body>Hello,<br /><br />You have carried out some research about the price of our shuttle service on our website alsace-navette.com.";
			$content_mail .= "<br />Please find below the summary of your request :<br />";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<strong>Depart</strong><br />";
			}
			$content_mail .= "<strong>Departure: </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
			$content_mail .= "<strong>Destination: </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
			$content_mail .= "<strong>Date: </strong>".$_SESSION['trajet']['date_depart_long']."<br />";
			$content_mail .= "<strong>Time: </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_aller))."<br />";
			$content_mail .= "<strong>Pick-up/Drop-off in Strasbourg: </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_aller'])."<br />";
			$content_mail .= "<strong>Number of passengers : </strong>".$nb_pers_aller."<br />";
			if($_SESSION['trajet']['pt_rass_aller'] == 4)
			{
				$content_mail .= "<strong>Address: </strong>".$_SESSION['trajet']['rass_adresse_aller']." ".
				$_SESSION['trajet']['rass_cp_aller']." ".
				$_SESSION['trajet']['rass_ville_aller']." ".$pays_domicile_aller."<br />";
			}
			
			$content_mail .= "<strong>Price shuttle: </strong>".$prix_navette_aller." €<br />";
			if($prix_dernière_minute_aller!=0)
			{
			$content_mail .= "<strong>Last minute request service: </strong>".$prix_dernière_minute_aller." € <br />";
			}
			
			if($prix_horaire_demande_aller != 0)
			{
			$content_mail .= "<strong>Time on request service: </strong>".$prix_horaire_demande_aller." € <br />";
			}	
			
			if($prix_horaire_nuit_aller != 0)
			{
			$content_mail .= "<strong>Increase night service: </strong>".$prix_horaire_nuit_aller." € <br />";
			}
			
			if($prix_montant_domicile_aller !=0)
			{
			$content_mail .= "<strong>Taken at home service: </strong>".$prix_montant_domicile_aller." € <br />";
			}
			
			if($prix_remise_aller != 0)
			{
			$content_mail .= "<strong>Discount 8 people: </strong>-".$prix_remise_aller." € <br />";
			}
	$prix_aller = $prix_navette_aller + $prix_dernière_minute_aller + $prix_horaire_demande_aller + $prix_horaire_nuit_aller + $prix_montant_domicile_aller - $prix_remise_aller;
			$content_mail .= "<strong>Total fare: </strong>".$prix_aller." €";
			$content_mail .= "";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<br /><br /><strong>Return</strong><br />";
				$content_mail .= "<strong>Departure: </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
				$content_mail .= "<strong>Destination: </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
				$content_mail .= "<strong>Date: </strong>".$_SESSION['trajet']['date_retour_long']."<br />";
				$content_mail .= "<strong>Time: </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_retour))."<br />";
				$content_mail .= "<strong>Pick-up/Drop-off in Strasbourg: </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_retour'])."<br />";
			$content_mail .= "<strong>Number of passengers : </strong>".$nb_pers_retour."<br />";
				if($_SESSION['trajet']['pt_rass_retour'] == 4)
				{
					$content_mail .= "<strong>Address : </strong>".$_SESSION['trajet']['rass_adresse_retour']." ".
					$_SESSION['trajet']['rass_cp_retour']." ".
					$_SESSION['trajet']['rass_ville_retour']." ".$pays_domicile_retour."<br />";
				}
				$content_mail .= "<strong>Price shuttle: </strong>".$prix_navette_retour." €<br />";
			if($prix_dernière_minute_retour!=0)
			{
			$content_mail .= "<strong>Last minute request service: </strong>".$prix_dernière_minute_retour." € <br />";
			}
			
			if($prix_horaire_demande_retour != 0)
			{
			$content_mail .= "<strong>Time on request service: </strong>".$prix_horaire_demande_retour." € <br />";
			}	
			
			if($prix_horaire_nuit_retour != 0)
			{
			$content_mail .= "<strong>Increase night service: </strong>".$prix_horaire_nuit_retour." € <br />";
			}
			
			if($prix_montant_domicile_retour !=0)
			{
			$content_mail .= "<strong>Taken at home service: </strong>".$prix_montant_domicile_retour." € <br />";
			}
			if($prix_remise_retour !=0)
			{
			$content_mail .= "<strong>Discount 8 people: </strong>-".$prix_remise_retour." € <br />";
			}
	$prix_retour = $prix_navette_retour + $prix_dernière_minute_retour + $prix_horaire_demande_retour + $prix_horaire_nuit_retour + $prix_montant_domicile_retour - $prix_remise_retour;		
				$content_mail .= "<strong>Total fare: </strong>".$prix_retour." €";
				$content_mail .= "";
			
			
			
			}
			$content_mail .= "<br /><br /><strong>This is just a price information which does not require any commitment from you. </strong>";
			$content_mail .= "<br /><br />We hope you have a good day! <br /><br /><br />";
			$content_mail .= "alsace-navette.com/aeroport <br />2 rue du Coq 67000 Strasbourg <br />OFFICE : +33 (0) 388 222 271 <br/>URGENCE : +33 (0) 627 181 252 <br />info@alsace-navette.com</body></html>";
    		break;
			
			default:
 			$content_mail = "<html><head></head><body>Bonjour,<br /><br />Vous avez effectué une recherche d'informations tarifaires de navette sur notre site alsace-navette.com.";
			$content_mail .= "<br />Veuillez trouver ci-dessous le récapitulatif :<br /><br />";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<strong>Aller</strong><br />";
			}
			$content_mail .= "<strong>Départ : </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
			$content_mail .= "<strong>Destination : </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
			$content_mail .= "<strong>Date : </strong>".$_SESSION['trajet']['date_depart_long']."<br />";
			$content_mail .= "<strong>Heure : </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_aller))."<br />";
			$content_mail .= "<strong>Point de prise/dépose sur Strasbourg : </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_aller'])."<br />";
			$content_mail .= "<strong>Nombre de passagers : </strong>".$nb_pers_aller."<br />";
			if($_SESSION['trajet']['pt_rass_aller'] == 4)
			{
				$content_mail .= "<strong>A l'adresse : </strong>".$_SESSION['trajet']['rass_adresse_aller']." ".
				$_SESSION['trajet']['rass_cp_aller']." ".
				$_SESSION['trajet']['rass_ville_aller']." ".$pays_domicile_aller."<br />";
			}
			
			$content_mail .= "<strong>Prix de la navette : </strong>".$prix_navette_aller." €<br />";
			if($prix_dernière_minute_aller!=0)
			{
			$content_mail .= "<strong>Demande de dernière minute : </strong>".$prix_dernière_minute_aller." € <br />";
			}
			
			if($prix_horaire_demande_aller != 0)
			{
			$content_mail .= "<strong>Horaires à la demande : </strong>".$prix_horaire_demande_aller." € <br />";
			}	
			
			if($prix_horaire_nuit_aller != 0)
			{
			$content_mail .= "<strong>Majoration de nuit : </strong>".$prix_horaire_nuit_aller." € <br />";
			}
			
			if($prix_montant_domicile_aller !=0)
			{
			$content_mail .= "<strong>Prise à domicile : </strong>".$prix_montant_domicile_aller." € <br />";
			}
			
			if($prix_remise_aller != 0)
			{
			$content_mail .= "<strong>Remise 8 personnes : </strong>-".$prix_remise_aller." € <br />";
			}
	$prix_aller = $prix_navette_aller + $prix_dernière_minute_aller + $prix_horaire_demande_aller + $prix_horaire_nuit_aller + $prix_montant_domicile_aller - $prix_remise_aller;			
			$content_mail .= "<strong>Prix total du trajet : </strong>".$prix_aller." €";
			$content_mail .= "";
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$content_mail .= "<br /><br /><strong>Retour</strong><br />";
				$content_mail .= "<strong>Départ : </strong>".get_lieu($_SESSION['trajet']['dest'])."<br />";
				$content_mail .= "<strong>Destination : </strong>".get_lieu($_SESSION['trajet']['depart'])."<br />";
				$content_mail .= "<strong>Date : </strong>".$_SESSION['trajet']['date_retour_long']."<br />";
				$content_mail .= "<strong>Heure : </strong>".str_replace(':', 'h', date('H:i', $tps_rassemblement_retour))."<br />";
				$content_mail .= "<strong>Point de prise/dépose sur Strasbourg : </strong>".get_pt_rass($_SESSION['trajet']['pt_rass_retour'])."<br />";
			$content_mail .= "<strong>Nombre de passagers : </strong>".$nb_pers_retour."<br />";
				if($_SESSION['trajet']['pt_rass_retour'] == 4)
				{
					$content_mail .= "<strong>A l'adresse : </strong> ".$_SESSION['trajet']['rass_adresse_retour']." ".
					$_SESSION['trajet']['rass_cp_retour']." ".
					$_SESSION['trajet']['rass_ville_retour']." ".$pays_domicile_retour."<br />";
				}
				
			$content_mail .= "<strong>Prix de la navette : </strong>".$prix_navette_retour." €<br />";
			if($prix_dernière_minute_retour!=0)
			{
			$content_mail .= "<strong>Demande de dernière minute : </strong>".$prix_dernière_minute_retour." € <br />";
			}
			
			if($prix_horaire_demande_retour != 0)
			{
			$content_mail .= "<strong>Horaires à la demande : </strong>".$prix_horaire_demande_retour." € <br />";
			}	
			
			if($prix_horaire_nuit_retour != 0)
			{
			$content_mail .= "<strong>Majoration de nuit : </strong>".$prix_horaire_nuit_retour." € <br />";
			}
			
			if($prix_montant_domicile_retour !=0)
			{
			$content_mail .= "<strong>Prise à domicile : </strong>".$prix_montant_domicile_retour." € <br />";
			}
			if($prix_remise_retour !=0)
			{
			$content_mail .= "<strong>Remise 8 personnes : </strong>-".$prix_remise_retour." € <br />";
			}
	$prix_retour = $prix_navette_retour + $prix_dernière_minute_retour + $prix_horaire_demande_retour + $prix_horaire_nuit_retour + $prix_montant_domicile_retour - $prix_remise_retour;			
			$content_mail .= "<strong>Prix total du trajet : </strong>".$prix_retour." €";
			$content_mail .= "";
			
			}
			$content_mail .= "<br /> <br/><strong>Ceci n'est qu'une information tarifaire, sans aucun engagement de votre part.</strong>";
			$content_mail .= ".<br /><br />Alsace-navette vous souhaite une agréable journée !<br /><br /><br />";
			$content_mail .= "alsace-navette.com/aeroport <br />2 rue du Coq 67000 Strasbourg <br />OFFICE : +33 (0) 388 222 271 <br/>URGENCE : +33 (0) 627 181 252 <br />info@alsace-navette.com</body></html>";
            break;
            
        }
			
			switch($langue){   
					
				case 'fr': 				
					$mailer->Subject = "Recherche de navette avec Alsace-navette.com";
					break;
					
				case 'en': 				
					$mailer->Subject = "Search of a shuttle with Alsace-navette.com";
					break;
				
				default:				
					$mailer->Subject = "Recherche de navette avec Alsace-navette.com";
					break;
			}
				
				$mailer->Body = $content_mail;
			//	$mailer->AddAddress("info@alsace-navette.com");
				$mailer->AddAddress($mail_client);
				
				$res_mail = $mailer->Send();
				
				
				

/*}
    else
	{
		header('Location: index.html');
		exit();
	}*/



