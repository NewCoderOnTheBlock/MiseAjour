<?php
	session_start();
	
	require_once('../includes/tpl_base.php');
	
	unset($_SESSION['fin_resa']);

	if(isset($_POST['res_1']) || isset($_GET['res_1']))
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
								'ARIANE' => $ariane_reservation_info_client,
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

		
		if(!isset($_SESSION['info_trajet_ok']) && intval($_POST['res_1']) == 1)
		{
			$_SESSION['trajet']['type_trajet'] = intval(trim($_POST['type_trajet']));
			$_SESSION['trajet']['depart'] = intval(trim($_POST['lst_trajet_depart']));
			$_SESSION['trajet']['dest'] = intval(trim($_POST['lst_trajet_arrive']));
			$_SESSION['trajet']['retour'] = $_SESSION['trajet']['dest'];
			$_SESSION['trajet']['pt_rass_aller'] = intval(trim($_POST['pt_rassemblement_aller']));
			$_SESSION['trajet']['pt_rass_retour'] = intval(trim($_POST['pt_rassemblement_retour']));
			$_SESSION['trajet']['rass_adresse_aller'] = htmlspecialchars(trim($_POST['rass_adresse_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_cp_aller'] = htmlspecialchars(trim($_POST['rass_cp_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_ville_aller'] = htmlspecialchars(trim($_POST['rass_ville_aller']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_adresse_retour'] = htmlspecialchars(trim($_POST['rass_adresse_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_cp_retour'] = htmlspecialchars(trim($_POST['rass_cp_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['rass_ville_retour'] = htmlspecialchars(trim($_POST['rass_ville_retour']), ENT_COMPAT, "UTF-8");
			$_SESSION['trajet']['compagnie_depart_vol'] = htmlspecialchars(trim($_POST['compagnie_depart_vol']), ENT_COMPAT, "UTF-8");
			
			
			if($_SESSION['trajet']['dest'] == 100)
			{
				$_SESSION['trajet']['provenance_depart_vol'] = htmlspecialchars(trim($_POST['provenance_depart_vol_2']), ENT_COMPAT, "UTF-8");
				$_SESSION['trajet']['provenance_depart_vol_1'] = htmlspecialchars(trim($_POST['provenance_depart_vol_1']), ENT_COMPAT, "UTF-8");
				$_SESSION['trajet']['provenance_depart_vol_2'] = htmlspecialchars(trim($_POST['provenance_depart_vol_2']), ENT_COMPAT, "UTF-8");
			}
			else
			{
				$_SESSION['trajet']['provenance_depart_vol'] = htmlspecialchars(trim($_POST['provenance_depart_vol_1']), ENT_COMPAT, "UTF-8");
				$_SESSION['trajet']['provenance_depart_vol_1'] = htmlspecialchars(trim($_POST['provenance_depart_vol_1']), ENT_COMPAT, "UTF-8");
				$_SESSION['trajet']['provenance_depart_vol_2'] = htmlspecialchars(trim($_POST['provenance_depart_vol_2']), ENT_COMPAT, "UTF-8");
			}
			
			
			
			$_SESSION['trajet']['heure_depart_vol'] = trim($_POST['heure_depart_vol']);
			$_SESSION['trajet']['minute_depart_vol'] = trim($_POST['minute_depart_vol']);
			$_SESSION['trajet']['date_depart'] = trim($_POST['jour_depart']);
			$_SESSION['trajet']['date_depart_long'] = trim($_POST['jour_depart_long']);
			$_SESSION['trajet']['date_retour'] = trim($_POST['jour_retour']);
			$_SESSION['trajet']['date_retour_long'] = trim($_POST['jour_retour_long']);
			$_SESSION['trajet']['passager_adulte_aller'] = intval(trim($_POST['lst_passager_adulte_aller']));
			$_SESSION['trajet']['passager_bebe_aller_g0'] = intval($_POST['lst_passager_enfant_aller_g0']);
			$_SESSION['trajet']['passager_bebe_aller_g1'] = intval($_POST['lst_passager_enfant_aller_g1']);
			$_SESSION['trajet']['passager_bebe_aller_g2'] = intval($_POST['lst_passager_enfant_aller_g2']);
			$_SESSION['trajet']['passager_bebe_aller_g3'] = intval($_POST['lst_passager_enfant_aller_g3']);
			$_SESSION['trajet']['passager_enfant_aller'] = intval(trim($_POST['lst_passager_enfant_aller']));
			$_SESSION['trajet']['info_compl'] = htmlspecialchars(trim($_POST['info_compl']), ENT_COMPAT, "UTF-8");
			
			$_SESSION['trajet']['depart_fixe'] = 0;
			$_SESSION['trajet']['retour_fixe'] = 0;
			$_SESSION['trajet']['bool_depart_fixe'] = false;
			$_SESSION['trajet']['bool_retour_fixe'] = false;
			
			
			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				$_SESSION['trajet']['passager_adulte_retour'] = intval(trim($_POST['lst_passager_adulte_retour']));
				$_SESSION['trajet']['passager_enfant_retour'] = intval(trim($_POST['lst_passager_enfant_retour']));
				$_SESSION['trajet']['passager_bebe_retour_g0'] = intval($_POST['lst_passager_enfant_retour_g0']);
				$_SESSION['trajet']['passager_bebe_retour_g1'] = intval($_POST['lst_passager_enfant_retour_g1']);
				$_SESSION['trajet']['passager_bebe_retour_g2'] = intval($_POST['lst_passager_enfant_retour_g2']);
				$_SESSION['trajet']['passager_bebe_retour_g3'] = intval($_POST['lst_passager_enfant_retour_g3']);
				$_SESSION['trajet']['compagnie_retour_vol'] = htmlspecialchars(trim($_POST['compagnie_retour_vol']), ENT_COMPAT, "UTF-8");
				
				if($_SESSION['trajet']['dest'] == 100)
				{
					$_SESSION['trajet']['provenance_retour_vol'] = htmlspecialchars(trim($_POST['provenance_retour_vol_2']), ENT_COMPAT, "UTF-8");
					$_SESSION['trajet']['provenance_retour_vol_1'] = htmlspecialchars(trim($_POST['provenance_retour_vol_1']), ENT_COMPAT, "UTF-8");
					$_SESSION['trajet']['provenance_retour_vol_2'] = htmlspecialchars(trim($_POST['provenance_retour_vol_2']), ENT_COMPAT, "UTF-8");
				}
				else
				{
					$_SESSION['trajet']['provenance_retour_vol'] = htmlspecialchars(trim($_POST['provenance_retour_vol_1']), ENT_COMPAT, "UTF-8");
					$_SESSION['trajet']['provenance_retour_vol_1'] = htmlspecialchars(trim($_POST['provenance_retour_vol_1']), ENT_COMPAT, "UTF-8");
					$_SESSION['trajet']['provenance_retour_vol_2'] = htmlspecialchars(trim($_POST['provenance_retour_vol_2']), ENT_COMPAT, "UTF-8");
				}

				$_SESSION['trajet']['heure_retour_vol'] = trim($_POST['heure_retour_vol']);
				$_SESSION['trajet']['minute_retour_vol'] = trim($_POST['minute_retour_vol']);
			}
			else
			{
				$_SESSION['trajet']['passager_adulte_retour'] = 0;
				$_SESSION['trajet']['passager_enfant_retour'] = 0;
				$_SESSION['trajet']['passager_bebe_retour_g0'] = 0;
				$_SESSION['trajet']['passager_bebe_retour_g1'] = 0;
				$_SESSION['trajet']['passager_bebe_retour_g2'] = 0;
				$_SESSION['trajet']['passager_bebe_retour_g3'] = 0;
				$_SESSION['trajet']['compagnie_retour_vol'] = "";
				$_SESSION['trajet']['provenance_retour_vol'] = "";
				$_SESSION['trajet']['provenance_retour_vol_1'] = "";
				$_SESSION['trajet']['provenance_retour_vol_2'] = "";
				$_SESSION['trajet']['heure_retour_vol'] = "0";
				$_SESSION['trajet']['minute_retour_vol'] = "0";
				
				$_SESSION['trajet']['heure_retour'] = "";
			}
		
	
			$tab_id_fixe = get_lieu_fixe();	

			
			if(in_array($_SESSION['trajet']['depart'], $tab_id_fixe) || in_array($_SESSION['trajet']['dest'], $tab_id_fixe))
			{				
				if($_POST['lst_heure_depart'] == '0')
				{
					$type_fixe = ($_SESSION['trajet']['depart'] == 100) ? "depart" : "retour";
					
					$_SESSION['trajet']['heure_depart'] = get_heure(intval($_POST['lst_fixe_depart']), $type_fixe);
					$_SESSION['trajet']['depart_fixe'] = intval($_POST['lst_fixe_depart']);
					$_SESSION['trajet']['heure_depart_fixe'] = intval($_POST['lst_fixe_depart']);
					$_SESSION['trajet']['bool_depart_fixe'] = true;
				}
				else
					$_SESSION['trajet']['heure_depart'] = trim($_POST['lst_heure_depart']);
			}
			else
				$_SESSION['trajet']['heure_depart'] = trim($_POST['lst_heure_depart']);

			if($_SESSION['trajet']['type_trajet'] == 0)
			{
				if(in_array($_SESSION['trajet']['depart'], $tab_id_fixe) || in_array($_SESSION['trajet']['dest'], $tab_id_fixe))
				{
					if($_POST['lst_heure_retour'] == '0')
					{
						$type_fixe = ($_SESSION['trajet']['dest'] == 100) ? "depart" : "retour";

						$_SESSION['trajet']['heure_retour'] = get_heure(intval($_POST['lst_fixe_retour']), $type_fixe);
						$_SESSION['trajet']['retour_fixe'] = intval($_POST['lst_fixe_retour']);
						$_SESSION['trajet']['heure_retour_fixe'] = intval($_POST['lst_fixe_retour']);
						$_SESSION['trajet']['bool_retour_fixe'] = true;
					}
					else
						$_SESSION['trajet']['heure_retour'] = trim($_POST['lst_heure_retour']);
				}
				else
					$_SESSION['trajet']['heure_retour'] = trim($_POST['lst_heure_retour']);
			}
		
		
			$rass = $_SESSION['trajet']['rass_adresse_aller'] . ' ' . $_SESSION['trajet']['rass_cp_aller'] . ' ' . addslashes($_SESSION['trajet']['rass_ville_aller']);
			
			if($_SESSION['trajet']['pt_rass_aller'] != 4)
			{
				$_SESSION['trajet']['rass_adresse_aller'] = "";
				$_SESSION['trajet']['rass_cp_aller'] = "";
				$_SESSION['trajet']['rass_ville_aller'] = "";
			}
			
			if($_SESSION['trajet']['pt_rass_retour'] != 4)
			{
				$_SESSION['trajet']['rass_adresse_retour'] = "";
				$_SESSION['trajet']['rass_cp_retour'] = "";
				$_SESSION['trajet']['rass_ville_retour'] = "";
			}
		}
		
		
		$tab_date_depart = explode('-', $_SESSION['trajet']['date_depart']);
		
	
		$annee_depart = intval($tab_date_depart[2]);
		$mois_depart = intval($tab_date_depart[1]);
		$jour_depart = intval($tab_date_depart[0]);

		$ok = true;
		
		if(strlen($_SESSION['trajet']['type_trajet']) <= 0 || strlen($_SESSION['trajet']['depart']) <= 0 || strlen($_SESSION['trajet']['dest']) <= 0 || $_SESSION['trajet']['pt_rass_aller'] <= 0 || strlen($_SESSION['trajet']['date_depart']) <= 0 || strlen($_SESSION['trajet']['date_depart_long']) <= 0 || strlen($_SESSION['trajet']['heure_depart']) <= 0 || strlen($_SESSION['trajet']['compagnie_depart_vol']) <= 0 || strlen($_SESSION['trajet']['provenance_depart_vol']) <= 0 || $_SESSION['trajet']['heure_depart_vol'] == "-" || $_SESSION['trajet']['minute_depart_vol'] == "-")
		{
			$ok = false;
			$_SESSION['erreur_erreur_ok'] = false;
			$_SESSION['erreur_erreur'] = $erreur_champ_vide;
		}
		else
		{
			if($_SESSION['trajet']['type_trajet'] == 0 && (strlen($_SESSION['trajet']['date_retour']) <= 0 || strlen($_SESSION['trajet']['date_retour_long']) <= 0 || strlen($_SESSION['trajet']['heure_retour']) <= 0 || $_SESSION['trajet']['pt_rass_aller'] <= 0 || strlen($_SESSION['trajet']['compagnie_retour_vol']) <= 0 || strlen($_SESSION['trajet']['provenance_retour_vol']) <= 0 || $_SESSION['trajet']['heure_retour_vol'] == "-" || $_SESSION['trajet']['minute_retour_vol'] == "-"))
			{
				$ok = false;
				$_SESSION['erreur_erreur_ok'] = false;
				$_SESSION['erreur_erreur'] = $erreur_champ_vide;
			}
			else
			{
				if($_SESSION['trajet']['type_trajet'] == 0)
				{
					$tab_date_retour = explode('-', $_SESSION['trajet']['date_retour']);
					
					$annee_retour = intval($tab_date_retour[2]);
					$mois_retour = intval($tab_date_retour[1]);
					$jour_retour = intval($tab_date_retour[0]);
		
					if(mktime(0, 0, 0, $mois_retour, $jour_retour, $annee_retour) - mktime(0, 0, 0, $mois_depart, $jour_depart, $annee_depart) < (3600 * 24))
					{
						$ok = false;
						$_SESSION['erreur_erreur_ok'] = false;
						$_SESSION['erreur_erreur'] = $erreur_date;
					}
					else
					{
						$_SESSION['info_trajet_ok'] = true;
						$_SESSION['erreur_erreur_ok'] = true;
					}
				}
				else
				{
					$_SESSION['info_trajet_ok'] = true;
					$_SESSION['erreur_erreur_ok'] = true;
				}
			}
		}
		
		
		if($_SESSION['logger'] && $_SESSION['client']['est_admin'] == "0")
		{
			header('Location: choix-navette.html?res_2=1');
			exit();
		}
		
		
		if((!isset($_POST['accept_cgv']) || $_POST['accept_cgv'] != "on") && !isset($_GET['client']))
		{
			$ok = false;
			$_SESSION['erreur_erreur_ok'] = false;
			$_SESSION['erreur_erreur'] = $erreur_accept_cgv;
		}
		
		
		if($ok)
		{
			$tab_civ = array();
			array_push($tab_civ, array("civilite" => "Mr"));
			array_push($tab_civ, array("civilite" => "Mme"));
			array_push($tab_civ, array("civilite" => "Mlle"));

			
			
			$_SESSION['class_erreur'] = "";
		
			if(isset($_SESSION['erreur_erreur_ok']) && !$_SESSION['erreur_erreur_ok'])
				$_SESSION['class_erreur'] = "erreur";
			else
				$_SESSION['erreur_erreur'] = "";
				
			$_SESSION['erreur_erreur_ok'] = true;
			
			
			// on est déjà client
			if(isset($_GET['client']) && $_GET['client'] == 1)
			{
				$_SESSION['class_erreur'] = "erreur";
				$_SESSION['erreur_erreur'] = $deja_client_question;
			}
			
			if(isset($_SESSION['client']['civilite']))
			{
				if($_SESSION['client']['est_admin'] == '0')
				{
					$tpl->set(array(
									"CIV_CHERCHE" => $_SESSION['client']['civilite'],
                                    "IND_FIXE_CHERCHE" => $_SESSION['client']['ind_fixe'],
                                    "IND_PORT_CHERCHE" => $_SESSION['client']['ind_port'],
									"PAYS_CHERCHE" => $_SESSION['client']['pays'], 
									"TXT_NOM_CLIENT" => $_SESSION['client']['nom'],
									"TXT_PRENOM_CLIENT" => $_SESSION['client']['prenom'],
									"TXT_EMAIL_CLIENT" => $_SESSION['client']['mail'],
									"TXT_TEL_CLIENT" => $_SESSION['client']['tel_fixe'],
									"TXT_PORT_CLIENT" => $_SESSION['client']['tel_port'],
                                    "TXT_IND_FIXE" => get_indicatif($_SESSION['client']['ind_fixe']),
                                    "TXT_IND_PORT" => get_indicatif($_SESSION['client']['ind_port']),
									"TXT_ADRESSE_CLIENT" => $_SESSION['client']['adresse'],
									"TXT_CODE_POST_CLIENT" => $_SESSION['client']['cp'],
									"TXT_VILLE_CLIENT" => $_SESSION['client']['ville']
									)
							  );
				}
				else
				{
					$tpl->set(array(
								"CIV_CHERCHE" => '',
                                "IND_FIXE_CHERCHE" => '',
                                "IND_PORT_CHERCHE" => '',
								"PAYS_CHERCHE" => 67, 
								"TXT_NOM_CLIENT" => '',
								"TXT_PRENOM_CLIENT" => '',
								"TXT_EMAIL_CLIENT" => '',
								"TXT_TEL_CLIENT" => '',
								"TXT_PORT_CLIENT" => '',
								"TXT_ADRESSE_CLIENT" => '',
								"TXT_CODE_POST_CLIENT" => '',
								"TXT_VILLE_CLIENT" => '',
                                "TXT_IND_FIXE" => '',
                                "TXT_IND_PORT" => ''
								)
						  );
				}
			}
			else
			{
				$tpl->set(array(
								"CIV_CHERCHE" => '',
                                "IND_FIXE_CHERCHE" => '',
                                "IND_PORT_CHERCHE" => '',
								"PAYS_CHERCHE" => 67, 
								"TXT_NOM_CLIENT" => '',
								"TXT_PRENOM_CLIENT" => '',
								"TXT_EMAIL_CLIENT" => '',
								"TXT_TEL_CLIENT" => '',
								"TXT_PORT_CLIENT" => '',
								"TXT_ADRESSE_CLIENT" => '',
								"TXT_CODE_POST_CLIENT" => '',
								"TXT_VILLE_CLIENT" => '',
                                "TXT_IND_FIXE" => '',
                                "TXT_IND_PORT" => ''
								)
						  );
			}
							
			
			
			$tpl->set(array(
							"TITRE_PAGE" => $titre_info_client,
							"TITRE" => $info_client,
							"TXT_DEJA_CLIENT" => $txt_deja_client,
							'DEJA__CLIENT' => (isset($_GET['client']) && $_GET['client'] == 1) ? true : false,
							"CLASS_ERREUR" => $_SESSION['class_erreur'],
							"ERREUR" => $_SESSION['erreur_erreur'],
							"OBLIGATOIRE" => $obligatoire,
							"OBLIGATOIRE_2" => $obligatoire_2,
							"BTN_RETOUR" => $retour,
							"BTN_RAZ" => $btn_raz,
							"BTN_CONTINUER" => $btn_etape_suivante,
							"CIVILITE" => $civilite,
							"NOM_CLIENT" => $nom_client,
							"PRENOM_CLIENT" => $prenom_client,
							"TEL_CLIENT" => $tel_client,
							"PORT_CLIENT" => $port_client,
							"ADRESSE_CLIENT" => $adresse_client,
							"CODE_POST_CLIENT" => $code_post_client,
							"VILLE_CLIENT" => $ville_client,
							"PAYS_CLIENT" => $pays_client,
							"TAB_PAYS" => get_tab_pays(),
                            "TAB_IND" => get_tab_ind(),
							"TAB_CIV" => $tab_civ,
							"LOGGER" => $_SESSION['logger'],
							"EMAIL" => $eemail,
                            "WARNING_TEL" => $warning_tel,
                            "INDICATIF" => $indicatif,
                            "EXPLI_INDICATIF" => $expli_indicatif
							)
					 );
			
			
			$_SESSION['debut_resa'] = "1";
				
			$tpl->parse('aeroport/reservation/info_client.html');
		}
		else
		{
			header('Location: ../index.html');	
			exit();
		}
	}
	else
	{
		header('Location: ../index.html');
		exit();
	}
	
?>
