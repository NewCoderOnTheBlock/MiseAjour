<?php

	session_start();

	require_once('includes/tpl_base.php');
	
	/*
		KEMPF : Ajout du traitement des données recus grace
		au petit formulaire de la page d'accueil
	*/
	
	if(isset($_POST['type_trajet']))
	{
		$_SESSION['trajet']['type_trajet'] = intval(trim($_POST['type_trajet']));
		$_SESSION['trajet']['depart'] = intval(trim($_POST['lst_trajet_depart']));
		$_SESSION['trajet']['dest'] = intval(trim($_POST['lst_trajet_arrive']));
		$_SESSION['trajet']['retour'] = $_SESSION['trajet']['dest'];
		
		if ($_SESSION['trajet']['depart'] == 100){
			$_SESSION['trajet']['provenance_depart_vol_1'] = "";
			$_SESSION['trajet']['provenance_retour_vol_1'] = "";
			$_SESSION['trajet']['provenance_depart_vol_2'] = get_lieu($_SESSION['trajet']['dest']);
			$_SESSION['trajet']['provenance_retour_vol_2'] = get_lieu($_SESSION['trajet']['dest']);
		}else{
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
			$_SESSION['trajet']['passager_adulte_retour'] = intval(trim($_POST['lst_passager_adulte_retour']));
			$_SESSION['trajet']['passager_enfant_retour'] = intval(trim($_POST['lst_passager_enfant_retour']));
		}
		else
		{
			$_SESSION['trajet']['passager_adulte_retour'] = 0;
			$_SESSION['trajet']['passager_enfant_retour'] = 0;
		}
	}
	
	if(isset($_POST['chckPassagerDifferent']))
	{
		// si le passager est different de celui qui reserve
		// INFO MARC
		
		if($_POST['chckPassagerDifferent']=="oui")
		{
			$_SESSION['lstIndicatifTelephone']=$_POST['lstIndicatifTelephone'];
			$_SESSION['txtPortable']=$_POST['txtPortable'];
			$_SESSION['txtNom']=$_POST['txtNom'];
			
					 //si on vient d'un aller simple la varibale de session txtIndicatif n'est pas creer
					if(!isset($_POST['txtIndicatifPortable'])){
		
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
		    				$_POST['txtIndicatifPortable']=$table_aeroport_pays['identifiant_tel'];
					  }
			
			$_SESSION['txtIndicatifPortable']=$_POST['txtIndicatifPortable'];
			$_SESSION['chckPassagerDifferent']="oui";
		}
	}
	else	//sinon 
	{
		$_SESSION['lstIndicatifTelephone']='';
		$_SESSION['txtPortable']='';				
		$_SESSION['txtNom']='';
		$_SESSION['txtIndicatifPortable'] = ""; // c'est juste pour affichage
		
		$_SESSION['chckPassagerDifferent']="non";
	}

	$type_reservation = "FORFAIT";

	// on attend pour l'aller 
	if(isset($_POST['attendre']) && $_POST['attendre'] == "on")
		$type_reservation = "ATTENDRE";

	if(isset($_POST['rb_navette_aller']) && $_POST['rb_navette_aller'] != '')
	{
		$_SESSION['etat_aller']['rb_navette'] = $_POST['rb_navette_aller'];
		$type_reservation = "RAJOUT";
	}
	else
	{
		$_SESSION['etat_aller']['rb_navette'] = "";
	}

	// si on choisit une navette existante

	if($_SESSION['etat_aller']['rb_navette'] != '')
	{
		$t = get_navette(intval($_POST['rb_navette_aller']));

		$_SESSION['etat_aller']['rajout'] = true;
		$_SESSION['etat_aller']['vehicule'] = $t['vehicule'];
		$_SESSION['etat_aller']['chauffeur'] = $t['chauffeur'];
		$_SESSION['etat_aller']['heure_depart'] = $t['date'];
		$_SESSION['trajet']['heure_depart'] = $t['date'];
		$_SESSION['trajet']['depart_fixe'] = $t['date'];
	}
	else
		$_SESSION['etat_aller']['rajout'] = false;

	
	$_SESSION['etat_aller']['type_reservation'] = $type_reservation;


	if($_SESSION['trajet']['pt_rass_aller'] == 4)
	{
		$_SESSION['etat_aller']['distance'] = intval($_POST['distance']);
		$_SESSION['etat_aller']['decalage'] = intval($_POST['decalage']);
	}
	
	$_SESSION['etat_retour']['distance'] = 0;
	$_SESSION['etat_retour']['decalage'] = 0;

	if($_SESSION['trajet']['type_trajet'] == '0')
	{
		$type_reservation = "RAJOUT";

		if(isset($_POST['accept_forfait_mini']) && $_POST['accept_forfait_mini'] == "on")
			$type_reservation = "FORFAIT";


		// on attend pour le retour
		if(isset($_POST['attendre']) && $_POST['attendre'] == "on")
			$type_reservation = "ATTENDRE";

		if(isset($_POST['rb_navette_retour']))
		{
			$_SESSION['etat_retour']['rb_navette'] = $_POST['rb_navette_retour'];
		}
		else
		{
			$_SESSION['etat_retour']['rb_navette'] = "";
		}


		// si on choisit une navette existante
	if(isset($_POST['rb_navette_retour'])){
		if($_POST['rb_navette_retour'] != '')
		{
			$t = get_navette(intval($_POST['rb_navette_retour']));

			$_SESSION['vehicule_id_retour'] = $t['vehicule'];
			$_SESSION['chauffeur_id_retour'] = $t['chauffeur'];
			$_SESSION['trajet']['heure_retour'] = $t['date'];
			$_SESSION['trajet']['retour_fixe'] = $t['date'];
		}
	}
		/*if($_SESSION['etat_aller']['rajout'])
		{
			$_SESSION['vehicule_id_aller'] = $_SESSION['etat_aller']['vehicule'];
			$_SESSION['chauffeur_id_aller'] = $_SESSION['etat_aller']['chauffeur'];
			$_SESSION['trajet']['heure_depart'] = $_SESSION['etat_aller']['heure_depart'];
		}*/


		$_SESSION['etat_retour']['type_reservation'] = $type_reservation;

		if($_SESSION['trajet']['pt_rass_retour'] == 4)
		{
			$_SESSION['etat_retour']['distance'] = intval($_POST['distance']);
			$_SESSION['etat_retour']['decalage'] = intval($_POST['decalage']);
		}
	}
	
	$_SESSION['demande_reservation']['connection'] = 1;
	
	unset($_SESSION['info_trajet_ok']);
	unset($_SESSION['fin_resa']);
	unset($_SESSION['est_alle_page_reservation']);

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

    $tpl->set("SELECTIONNER_DATE_DEPART_2", $selectionner_date_depart);

	
	$tab_heure = array(array('code_heure' => '0', 'heure' => '- - h - - '));
	
	$tab_heure2 = array(array('code_heure' => '-', 'heure' => ' - '));
	
	$lst_heure_fixe = array(array('code_heure' => '0', 'heure' => '- - h - - '));
	
	for($i = 0; $i < 24; $i++)
	{
		$heure = (strlen($i) == 1) ? '0' . $i : $i;
		
		$tab_heure2[] =  array('code_heure' => $heure, 'heure' => $heure);
		
		$lst_heure_fixe[] = array('code_heure' => $heure . ":00", 'heure' => $heure . "h00");
		
		$tab_heure[] = array('code_heure' => $heure . ":00", 'heure' => $heure . "h00");
		
		//$tab_heure[] = array('code_heure' => $heure . ":30", 'heure' => $heure . "h30");
	}
	
	$tab_minute = array(array('code_heure' => '-', 'heure' => ' - '));
	
	for($i = 0; $i < 60; $i++)
	{
		if($i % 5 == 0)
		{
			$heure = (strlen($i) == 1) ? '0' . $i : $i;
			
			$tab_minute[] = array('code_heure' => $heure, 'heure' => $heure);
		}
	}
	
	$tab_personne = array();
	
	for($i = 1; $i <= 8; $i++)
		$tab_personne[] = array('personne' => $i);
	
	
	$tab_enfant = array();
	
	for($i = 0; $i <= 5; $i++)
		$tab_enfant[] = array('personne' => $i);
		

	$_SESSION['class_erreur'] = "";
	
	if(isset($_SESSION['erreur_erreur_ok']) && !$_SESSION['erreur_erreur_ok'])
		$_SESSION['class_erreur'] = "erreur";
	else
		$_SESSION['erreur_erreur'] = "";
		
	$_SESSION['erreur_erreur_ok'] = true;
	
	
	$_SESSION['client']['pays'] = (empty($_SESSION['client']['pays'])) ? 66 : $_SESSION['client']['pays'];
	
	
	$tab_video = list_dir('./videos');
	$nom_video = $tab_video[mt_rand(0, (count($tab_video)-1))];
	
	$tab_photos = array();
	$tab_photo = list_dir('./photos', "mini_");
	$tab_alea = array();
	
	for($i = 0; $i < 10; $i++)
	{
		$nb_alea = mt_rand(0, (count($tab_photo)-1));
		
		if(!in_array($nb_alea, $tab_alea))
		{
			$tab_alea[] = $nb_alea;
			$tab_photos[] = array('PHOTO' => $tab_photo[$nb_alea]);
		}
	}
	
	
	if(isset($_SESSION['trajet']))
	{	
		$selectionner_date_depart = (!empty($_SESSION['trajet']['date_depart']) && !empty($_SESSION['trajet']['date_depart_long'])) ? $_SESSION['trajet']['date_depart_long'] : $selectionner_date_depart;
        $selectionner_date_retour = (!empty($_SESSION['trajet']['date_retour']) && !empty($_SESSION['trajet']['date_retour_long'])) ? $_SESSION['trajet']['date_retour_long'] : $selectionner_date_retour;
	
	if(!isset($_SESSION['etat_retour']['rb_navette'])){
		$_SESSION['etat_retour']['rb_navette']="";	
	}
	if(!isset($_SESSION['trajet']['code_promo'])){
		$_SESSION['trajet']['code_promo']=0;
	}
		$tpl->set(array(
						"DEP_CHERCHE" => $_SESSION['trajet']['depart'],
						"DEST_CHERCHE" => $_SESSION['trajet']['dest'],
						"TXT_COMPAGNIE_DEPART_VOL" => $_SESSION['trajet']['compagnie_depart_vol'],
						"TXT_PROVENANCE_DEPART_VOL_1" => $_SESSION['trajet']['provenance_depart_vol_1'],
						"TXT_PROVENANCE_DEPART_VOL_2" => $_SESSION['trajet']['provenance_depart_vol_2'],
						"TXT_HEURE_DEPART_VOL" => $_SESSION['trajet']['heure_depart_vol'],
						"TXT_MINUTE_DEPART_VOL" => $_SESSION['trajet']['minute_depart_vol'],
						"TXT_COMPAGNIE_RETOUR_VOL" => $_SESSION['trajet']['compagnie_retour_vol'],
						"TXT_PROVENANCE_RETOUR_VOL_1" => $_SESSION['trajet']['provenance_retour_vol_1'],
						"TXT_PROVENANCE_RETOUR_VOL_2" => $_SESSION['trajet']['provenance_retour_vol_2'],
						"TXT_HEURE_RETOUR_VOL" => $_SESSION['trajet']['heure_retour_vol'],
						"TXT_MINUTE_RETOUR_VOL" => $_SESSION['trajet']['minute_retour_vol'],
						"PT_RASSEMBLEMENT_ALLER_CHERCHE" => $_SESSION['trajet']['pt_rass_aller'],
						"PT_RASSEMBLEMENT_RETOUR_CHERCHE" => $_SESSION['trajet']['pt_rass_retour'],
						/**/
						"PT_PAYS_ALLER_CHERCHE" => $_SESSION['trajet']['rass_pays_aller'],
						"PT_PAYS_RETOUR_CHERCHE" => $_SESSION['trajet']['rass_pays_retour'],
						/**/
						"TXT_JOUR_DEPART_LONG" => $_SESSION['trajet']['date_depart_long'],
						"TXT_JOUR_DEPART" => $_SESSION['trajet']['date_depart'],
						"TXT_JOUR_RETOUR_LONG" => $_SESSION['trajet']['date_retour_long'],
						"TXT_JOUR_RETOUR" => $_SESSION['trajet']['date_retour'],
						"HEURE_DEPART_CHERCHE" => $_SESSION['trajet']['heure_depart'],
						"HEURE_RETOUR_CHERCHE" => $_SESSION['trajet']['heure_retour'],
						"HEURE_FIXE_ALLER" => $_SESSION['trajet']['depart_fixe'],
						"HEURE_FIXE_RETOUR" => $_SESSION['trajet']['retour_fixe'],
						"CHANGE_ALLER" => $_SESSION['etat_aller']['rb_navette'],
						"CHANGE_RETOUR" => $_SESSION['etat_retour']['rb_navette'],
						"NOUVEL_HORAIRE_ALLER" => str_replace(':','h',$_SESSION['trajet']['heure_depart']),
						"NOUVEL_HORAIRE_RETOUR" => str_replace(':','h',$_SESSION['trajet']['heure_retour']),
						"NB_PERSONNE_CHERCHE_ALLER" => $_SESSION['trajet']['passager_adulte_aller'],
						"NB_ENFANT_CHERCHE_ALLER" => $_SESSION['trajet']['passager_enfant_aller'],
						"NB_ENFANT_CHERCHE_ALLER_G0" => $_SESSION['trajet']['passager_bebe_aller_g0'],
						"NB_ENFANT_CHERCHE_ALLER_G1" => $_SESSION['trajet']['passager_bebe_aller_g1'],
						"NB_ENFANT_CHERCHE_ALLER_G2" => $_SESSION['trajet']['passager_bebe_aller_g2'],
						"NB_ENFANT_CHERCHE_ALLER_G3" => $_SESSION['trajet']['passager_bebe_aller_g3'],
						"NB_ENFANT_CHERCHE_RETOUR_G0" => $_SESSION['trajet']['passager_bebe_retour_g0'],
						"NB_ENFANT_CHERCHE_RETOUR_G1" => $_SESSION['trajet']['passager_bebe_retour_g1'],
						"NB_ENFANT_CHERCHE_RETOUR_G2" => $_SESSION['trajet']['passager_bebe_retour_g2'],
						"NB_ENFANT_CHERCHE_RETOUR_G3" => $_SESSION['trajet']['passager_bebe_retour_g3'],
						"NB_PERSONNE_CHERCHE_RETOUR" => $_SESSION['trajet']['passager_adulte_retour'],
						"NB_ENFANT_CHERCHE_RETOUR" => $_SESSION['trajet']['passager_enfant_retour'],
						"TXT_INFO_COMPL" => $_SESSION['trajet']['info_compl'],
						"TRAJET" => $_SESSION['trajet']['type_trajet'],
						"TXT_RASS_ADRESSE_ALLER" => $_SESSION['trajet']['rass_adresse_aller'],
						"TXT_RASS_CP_ALLER" => $_SESSION['trajet']['rass_cp_aller'],
						"TXT_RASS_VILLE_ALLER" => $_SESSION['trajet']['rass_ville_aller'],
						"TXT_RASS_ADRESSE_RETOUR" => $_SESSION['trajet']['rass_adresse_retour'],
						"TXT_RASS_CP_RETOUR" => $_SESSION['trajet']['rass_cp_retour'],
						"TXT_RASS_VILLE_RETOUR" => $_SESSION['trajet']['rass_ville_retour'],
						"TXT_CODE_PROMO" => $_SESSION['trajet']['code_promo']
						)
				  );
	}
	else
	{
		
		$tpl->set(array(
						"DEP_CHERCHE" => '',
						"DEST_CHERCHE" => '',
						"TXT_COMPAGNIE_DEPART_VOL" => '',
						"TXT_PROVENANCE_DEPART_VOL_2" => '',
						"TXT_PROVENANCE_DEPART_VOL_1" => '',
						"TXT_HEURE_DEPART_VOL" => '',
						"TXT_MINUTE_DEPART_VOL" => '',
						"TXT_COMPAGNIE_RETOUR_VOL" => '',
						"TXT_PROVENANCE_RETOUR_VOL_2" => '',
						"TXT_PROVENANCE_RETOUR_VOL_1" => '',
						"TXT_HEURE_RETOUR_VOL" => '',
						"TXT_MINUTE_RETOUR_VOL" => '',
						"PT_RASSEMBLEMENT_ALLER_CHERCHE" => '',
						"PT_RASSEMBLEMENT_RETOUR_CHERCHE" => '',
						"TXT_JOUR_DEPART_LONG" => '',
						"TXT_JOUR_DEPART" => '',
						"TXT_JOUR_RETOUR_LONG" => '',
						"TXT_JOUR_RETOUR" => '',
						"HEURE_DEPART_CHERCHE" => '',
						"HEURE_RETOUR_CHERCHE" => '',
						"HEURE_FIXE_ALLER" => '',
						"HEURE_FIXE_RETOUR" => '',
						"NOUVEL_HORAIRE_ALLER" => '',
						"NOUVEL_HORAIRE_RETOUR" => '',
						"NB_PERSONNE_CHERCHE_ALLER" => '',
						"NB_ENFANT_CHERCHE_ALLER" => '',
						"NB_ENFANT_CHERCHE_ALLER_G0" => '',
						"NB_ENFANT_CHERCHE_ALLER_G1" => '',
						"NB_ENFANT_CHERCHE_ALLER_G2" => '',
						"NB_ENFANT_CHERCHE_ALLER_G3" => '',
						"NB_ENFANT_CHERCHE_RETOUR_G0" => '',
						"NB_ENFANT_CHERCHE_RETOUR_G1" => '',
						"NB_ENFANT_CHERCHE_RETOUR_G2" => '',
						"NB_ENFANT_CHERCHE_RETOUR_G3" => '',
						"NB_PERSONNE_CHERCHE_RETOUR" => '',
						"NB_ENFANT_CHERCHE_RETOUR" => '',
						"TXT_INFO_COMPL" => '',
						"TRAJET" => '',
						"TXT_RASS_ADRESSE_ALLER" => '',
						"TXT_RASS_CP_ALLER" => '',
						"TXT_RASS_VILLE_ALLER" => '',
						"TXT_RASS_PAYS_ALLER" => '',
						"TXT_RASS_ADRESSE_RETOUR" => '',
						"TXT_RASS_CP_RETOUR" => '',
						"TXT_RASS_VILLE_RETOUR" => '',
						"TXT_RASS_PAYS_RETOUR" => ''
						)
				  );
	}
    
		
	$tpl->set(array(
					"CLASS_ERREUR" => $_SESSION['class_erreur'],
					"ERREUR" => $_SESSION['erreur_erreur'],
					"TITRE_PAGE" => $titre_page_accueil,
					"LEGEND_TRAJET" => $legend_trajet,
					"TRAJET_TYPE" => $trajet_type,
					"TRAJET_ALLER_SIMPLE" => $trajet_aller_simple,
					"TRAJET_ALLER_RETOUR" => $trajet_aller_retour,
					"TRAJET_DEPART" => $trajet_depart,
					"TRAJET_ARRIVE" => $trajet_arrive,
					"DATE_DEPART" => $date,
					"DATE_RETOUR" => $date,
					"HEURE_DEPART" => $heure_depart,
					"HEURE_RETOUR" => $heure_retour,
					"FIXE_ALLER" => $depart_fixe,
					"FIXE_RETOUR" => $retour_fixe,
					"SELECTIONNER_DATE_DEPART" => $selectionner_date_depart,
					"SELECTIONNER_DATE_RETOUR" => $selectionner_date_retour,
					"ALT_CALENDRIER" => $alt_calendrier,
					"OBLIGATOIRE" => $obligatoire,
					"OBLIGATOIRE_2" => $obligatoire_2,
					"INFO_VOL" => $info_vol,
					"INFO_TRANSPORT" => $info_transport,
					"PT_RASSEMBLEMENT" => $pt_rassemblement,
					"LST_PT_RASSEMBLEMENT" => get_liste_rassemblement(),
					/**/
					"LST_PAYS" => get_liste_pays(),
					/**/
					"LST_DEPART" => get_liste_aeroport(),
					"PASSAGER_ADULTE" => $passager_adulte,
					"PASSAGER_ENFANT" => htmlspecialchars($passager_enfant, ENT_COMPAT, "UTF-8"),
					"INFO_COMPL" => $info_compl,
					"LEGEND_CLIENT" => $legend_client,
					"LST_HEURE" => $tab_heure,
					"LST_PERSONNE" => $tab_personne,
					"LST_ENFANT" => $tab_enfant,
					"ADRESSE_CLIENT" => $adresse_client,
					"CODE_POST_CLIENT" => $code_post_client,
					"VILLE_CLIENT" => $ville_client,
					"PAYS_CLIENT" => $pays_client,
					"CODE_PROMO" => $code_promo,
					"FRANCE" => $france,
					"ALLEMAGNE" => $allemagne,
					"SUISSE" => $suisse,
					"BELGIQUE" => $belgique,
					"LUXEMBOURG" => $luxembourg,
					"BTN_RAZ" => $btn_raz,
					"BTN_ENVOYER" => $btn_envoyer,
					"PROVENANCE_VOL" => $provenance_vol,
					"COMPAGNIE_VOL" => $compagnie_vol,
					"HEURE_VOL" => $heure_vol,
					"DEST_VOL" => $dest_vol,
					"LOGGER" => $_SESSION['logger'],
					"ALLER" => $aller,
					"RETOUR" => $retour,
					"ALT_AIDE" => $alt_aide,
					"LST_HEURE_FIXE" => $lst_heure_fixe,
					"FIXE_DEST" => tab_fixe(),
					"PASSAGER_ENFANT_G0" => $enfant_g0,
					"PASSAGER_ENFANT_G1" => $enfant_g1,
					"PASSAGER_ENFANT_G2" => $enfant_g2,
					"PASSAGER_ENFANT_G3" => $enfant_g3,
					"NOM_VIDEO" => $nom_video,
					"NOMBRE_PASSAGER" => $nombre_passager,
					"RESERVATION" => $ariane_reserver,
					"TITLE_RESERVATION" => $title_reservation,
					"HEURE_LST" => $tab_heure2,
					"MINUTE_LST" => $tab_minute,
					"TAB_PHOTOS" => $tab_photos,
					"ERREUR_FLASH" => $erreur_flash,
					"VISITER_ALSACE" => $visiter_alsace,
					"NAVETTE_VOL" => $navette_vol,
					"CHOIX_AEROPORT" => $choix_aeroport,
					"A_DEST_DE" => $a_dest_de,
					"EN_PROV_DE" => $en_prov_de,
					"MEILLEURS_PRIX" => $meilleurs_prix,
					"PHOTOS" => $photos,
					"HOVER_AIDE_FIXE" => $hover_aide_fixe,
					"HOVER_AIDE" => $hover_aide,
					"TXT_CHANGER_INFO_PERSO" => $txt_changer_info_perso,
					"METEO" => $meteo,
					"TXT_ACCEPT_CGV" => $accept_cgv,
                    "MODE_DE_PAIEMENT" => $mode_de_paiement,
                    "ALT_PAYPAL" => $alt_paypal,
                    "RECHERCHE_DE_NAVETTE" => $recherche_de_navette,
                    "BTN_RECHERCHE" => $btn_recherche,
                    "NEWS" => $speed_news,
					"SONDAGE" => $alt_sondage,
					"TITRE_COMPAGNIE" => $lang_titre_compagnies,
					
					// KEMPF: Programme de fildelité (Non validé)
					"TITRE_FIDELITE" => $programme_fidelite,
					"EXPLICATION_FIDELITE" => $lang_menu_fidelite,
					
					// KEMPF: Option annulation
					"CONFIRMATION" => $info_confirmation,
					"OPTION_ANNUL" => $lang_annulation,
					"EXPLI_OPTION_ANNUL" => $lang_expli_option_annulation,
					
					// KEMPF: Aides diverses
					"AIDE_PT_RASSEMBLEMENT" => $lang_aide_pt_rassemblement,
					"AIDE_VOL" => $lang_aide_vol,
					"AIDE_ENFANT" => $lang_aide_enfants,
					
					"EMAIL" => $email,
					"PASSWD" => $passwd,
					"MDP_OUBLIE" => $mdp_oublie,
					"AIDE_RESERVATION" => $aide_reservation,
					"ETAPE_1" => $etape1,
					"ETAPE_2" => $etape2,
					"ETAPE_3" => $etape3,
					"ETAPE_4" => $etape4,
					"HORAIRES_NAVETTES" => $horaires_navettes,
					"HORAIRES_VOLS" => $horaires_vols,
					"INFOS" => $infos,
					"POINTS_PRISE" => $points_prise,
					"HORAIRE_CHOISI" => $horaire_choisi
					)
			);
			
	$tpl->parse("aeroport/demande_reservation.html");

	
?>
