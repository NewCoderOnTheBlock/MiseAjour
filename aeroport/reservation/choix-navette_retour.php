<?php 
/*****
Nom du fichier : choix-navette_retour.php

Objectif :Creer le template de la page 3/5

******/


	session_start();

	require_once('../includes/tpl_base.php');
	require_once('./ressource.php');

	unset($_SESSION['fin_resa']);
	unset($_SESSION['debut_resa']);
	
	if (isset($_SESSION['est_alle_page_reservation'])){
		header('Location: ../demande_reservation.html');
		exit;
	}
	

	if(isset($_POST['res_2_2']))
	{
		// récupération des infos de l'aller


        $new = $_POST['navette_dispo']; // si rajout sur une navette

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
        
        $nb_pers = ($_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour']);

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

				$prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour']);
				
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
        if(get_nb_personne_forfait($idd_lieu) <= ($_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour']))
            $prix = $prix_personne * ($_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour']);
        else
            $prix = get_prix_forfait($idd_lieu);
			
		// KEMPF : Application de la remise pour 8 personnes ( A appliquer sur le tarif de base )
		if (($_SESSION['trajet']['passager_adulte_retour'] + $_SESSION['trajet']['passager_enfant_retour']) == 8){
			$remise_8_pers_pourcent = intval(get_option("remise_pourcent_8_pers"));
			$prix -= ($prix*($remise_8_pers_pourcent/100));
		}
		
		// Majoration de prise à domicile
		if($_SESSION['trajet']['pt_rass_retour'] == 4){
			$prix += $montant_maj_dom;	
		}
		
		// KEMPF : Ajout de la majoration des horaires de nuit		
		$majoration_nuit = (est_horaire_nuit($_SESSION['trajet']['heure_retour'])) ? $montant_maj_nuit : 0;
		
		$prix += $majoration_nuit;
		
		// On ajout le surcout pour les horaires à la demande
        if(!$_SESSION['trajet']['bool_retour_fixe']){
           $prix += get_option("maj_surcout_demande");
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


   	/**
	 * Pour recuperer le numero indicatif pays de la table aeroport_pays
	 * Marc
	 * **/            
    if(isset($_POST['chckPassagerDifferent']))
	{
		// si le passager est different de celui qui reserve
		// INFO MARC
				
		if($_POST['chckPassagerDifferent']=="oui")
		{		
				/*print_r($_SESSION);*/
?>
<br />
<?php

			    if($_SERVER["SERVER_ADDR"]=="::1" || $_SERVER["SERVER_ADDR"]=="127.0.0.1" || $_SERVER["SERVER_ADDR"]=="192.168.3.2") // si localhost
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
				            
					$ma_req="select identifiant_tel from  aeroport_pays where id_pays=".$_POST['lstIndicatifTelephone'];
				    $table_aeroport_pays=mysql_fetch_array(mysql_query($ma_req));
    
    				mysql_close($c);
		}
	}
	else{  //si aucune informations saisies on crees quand memes les variables
		$_POST['chckPassagerDifferent']="";
		$_POST['txtNom'] = "";
		$table_aeroport_pays['identifiant_tel']="";
		$_POST['lstIndicatifTelephone'] = "";
		$_POST['txtPortable']="";
	}
    /***
     * Fin pour la recuperation 
     * ***/
    
    
        $tpl->set(array(
                    "BTN_CONTINUER" => $btn_etape_suivante,
                    "TITRE_PAGE" => $titre_choix_navette,
                    "TITRE_MON_TRAJET" => $mon_trajet,
                    "GOOGLE_MAPS" => $_SESSION['google_maps'],
                    "REMBOURSEMENT_FORFAIT" => $remboursement_forfait,
                    "CHOIX_NAVETTE" => $choix_navette,
                    "TAB_HEADER" => get_tab_navette_existant(),
                    "TAB_NAVETTE_DISPO" => $tab_navette_dispo_retour,
                    "NAVETTE_EXISTANT" => $navette_existant_retour,
                    "NAVETTE" => $navette_retour,
                    "BOOL_NAV" => ($navette_retour) ? 1 : 0,
                    "ADDR" => $_SESSION['trajet']['rass_adresse_retour'] . ' ' . $_SESSION['trajet']['rass_cp_retour'] . ' ' . $_SESSION['trajet']['rass_ville_retour'],
                    "TYPE" => $type,
					"SUR_ADRESSE" => $sur_adresse,
                    "PB_ADRESSE" => $sur_adresse_retour . $_SESSION['trajet']['rass_adresse_retour'] . ' ' . $_SESSION['trajet']['rass_cp_retour'] . ' ' . $_SESSION['trajet']['rass_ville_retour'],
					"RETOUR" => $retour,
                    "AUCUNE_NAVETTE" => $aucune_navette,
					"NAVETTE_DISPONIBLE" => $navette_disponible,
                    "RESS" => $ress_retour,
                    "TXT_PAS_RESSOURCE" => $txt_pas_ressource_retour,
                    "PB_RESSOURCE" => (!$ress_retour) ? "1" : "0",
                    "CODE_POST" => $_SESSION['trajet']['rass_cp_retour'],
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
                    "LBL_TARIF_TRAJET" => $prix,
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
                    "CHOIX_1" => $choix . "1",
                    "CHOIX_2" => $choix . (($navette_retour) ? "2" : "1"),
                    "CHOIX_3" => $choix . (($ress_retour && $navette_retour) ? "3" : (($navette_retour && !$ress_retour) || (!$navette_retour && $ress_retour) ? "2" : ((!$navette_retour && !$ress_retour) ? "1" : ""))),
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
					
					// KEMPF : Données nécessaires pour la fonction AJAX de demande annulée
					
					"CIVILITE_CLIENT" => ($_SESSION['client']['civilite']),
					"NOM_CLIENT" => ($_SESSION['client']['nom']),
					"PRENOM_CLIENT" => ($_SESSION['client']['prenom']),
					"EMAIL_CLIENT" => $_SESSION['client']['mail'],
					"ID_TRAJET_DEPART" => $_SESSION['trajet']['depart'],
					"ID_TRAJET_DEST" => $_SESSION['trajet']['dest'],
					"TRAJET_EST_SIMPLE" => $_SESSION['trajet']['type_trajet'],
					"PRIX_TRAJET" => $prix,
					"DESELECTIONNER" => $deselectionner,
        			
        			/***
        			 * 
        			 * Texte utilisé à gauche
        			 * 
        			 * */
					"TITRE_A_COCHER_SI_LA_PERSONNE_EST_AUTRE" =>  $titre_a_cocher_si_la_personne_est_autre,
        			"TXT_NOM_PASSAGER" =>  $nom_autre_passager,
					"INDICATIF_TEL_AUTRE_PASSAGER" => $indicatif_tel_autre_passager,
					"TEL_PORT_AUTRE_PASSAGER" => $tel_port_autre_passager,
        
        			/********
        			 * 
        			 * Ces valeurs sont issues de la page choix-navette_aller.php
        			 * 
        			 ********/
					"VALEUR_CHECK_PASSAGER_DIFFERENT" => $_POST['chckPassagerDifferent'],
        			"VALEUR_NOM_ISSUE_ALLER" => $_POST['txtNom'],
        			"VALEUR_INDICATIF_TEL_AUTRE_PASSAGER_ISSUE_ALLER" =>  $table_aeroport_pays['identifiant_tel'],
        			"VALEUR_ID_PAYS_POUR_TEL" => $_POST['lstIndicatifTelephone'],
        			"VALEUR_PORT_AUTRE_PASSAGER_ISSUE_ALLER" => $_POST['txtPortable']
                    ));
        
        $tpl->parse("aeroport/reservation/navette_dispo_retour.html");
	}
	else
		{
			header('Location: ../index.html');	
			exit();
		}

?>
