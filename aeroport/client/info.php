<?php

	session_start();
	
	if(!$_SESSION['logger'])
	{
		header('Location: client.php?p='.$_SERVER['REQUEST_URI']);
		exit();
	}
	
	require_once('../includes/tpl_base.php');
	
	// le fil d'ariane
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $ariane_info_perso,
							'LIEN' => 'client/info.html'
							),
						array(
							'ARIANE' => $ariane_modif_info_perso,
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
	
	
	
	$tab_civ = array();
	array_push($tab_civ, array("civilite" => "Mr"));
	array_push($tab_civ, array("civilite" => "Mme"));
	array_push($tab_civ, array("civilite" => "Mlle"));



	$_SESSION['erreur_info'] = "";
	$_SESSION['class_info'] = "valide";
	$_SESSION['erreur_info_ok'] = true;
	
	if(isset($_POST['info']))
	{
		$_SESSION['client']['civilite'] = trim($_POST['lst_civ']);
		$_SESSION['client']['nom'] = trim($_POST['nom_client']);
		$_SESSION['client']['prenom'] = trim($_POST['prenom_client']);
		$_SESSION['client']['mail'] = trim($_POST['email_client']);
		$_SESSION['client']['tel_fixe'] = trim($_POST['tel_client']);
		$_SESSION['client']['tel_port'] = trim($_POST['port_client']);
		$_SESSION['client']['adresse'] = trim($_POST['adresse_client']);
		$_SESSION['client']['cp'] = trim($_POST['code_post_client']);
		$_SESSION['client']['ville'] = trim($_POST['ville_client']);
		$_SESSION['client']['pays'] = intval(trim($_POST['pays_client']));
        $_SESSION['client']['ind_fixe'] = intval($_POST['indicatif_fixe']);
        $_SESSION['client']['ind_port'] = intval($_POST['indicatif_port']);

        if(substr($_SESSION['client']['tel_port'], 0, 2) == "06")
            $_SESSION['client']['tel_port'] = substr($_SESSION['client']['tel_port'], 1);
		
		
		if(strlen($_SESSION['client']['nom']) <= 0 || strlen($_SESSION['client']['prenom']) <= 0 || strlen($_SESSION['client']['mail']) <= 0 || strlen($_SESSION['client']['ville']) <= 0)
		{
			// pas ok
			$_SESSION['erreur_info_ok'] = false;
			$_SESSION['erreur_info'] = $erreur_champ_vide;
			$_SESSION['class_info'] = "erreur";
		}
		else
		{
			if(strlen($_SESSION['client']['tel_fixe']) <= 0 && strlen($_SESSION['client']['tel_port']) <= 0)
			{
				// pas ok
				$_SESSION['erreur_info_ok'] = false;
				$_SESSION['erreur_info'] = $erreur_champ_vide;
				$_SESSION['class_info'] = "erreur";
			}
			else
			{
				// ok
				$sql = "UPDATE aeroport_client SET
					id_pays = '" . $_SESSION['client']['pays'] . "', 
					civilite = '" . $_SESSION['client']['civilite'] . "', 
					nom = '" . addslashes($_SESSION['client']['nom']) . "', 
					prenom = '" . addslashes($_SESSION['client']['prenom']) . "', 
					adresse = '" . addslashes($_SESSION['client']['adresse']) . "', 
					code_postal = '" . addslashes($_SESSION['client']['cp']) . "', 
					ville = '" . addslashes($_SESSION['client']['ville']) . "', 
					mail = '" . addslashes($_SESSION['client']['mail']) . "', 
					tel_fixe = '" . addslashes($_SESSION['client']['tel_fixe']) . "', 
					tel_port = '" . addslashes($_SESSION['client']['tel_port']) . "',
                    ind_fixe = '" . $_SESSION['client']['ind_fixe'] . "',
                    ind_port = '" . $_SESSION['client']['ind_port'] . "'
				WHERE id_client = '" . $_SESSION['client']['id_client'] . "'";

				write($sql);
				
				$_SESSION['erreur_info'] = $valide_new_info;
				$_SESSION['class_info'] = "valide";
				$_SESSION['erreur_info_ok'] = true;
				
				$tpl->set(array(
						"CIV_CHERCHE" => $_SESSION['client']['civilite'],
						"PAYS_CHERCHE" => $_SESSION['client']['pays'],
                        "IND_FIXE_CHERCHE" => $_SESSION['client']['ind_fixe'],
                        "IND_PORT_CHERCHE" => $_SESSION['client']['ind_port'],
						"TXT_NOM_CLIENT" => htmlspecialchars($_SESSION['client']['nom']),
						"TXT_PRENOM_CLIENT" => htmlspecialchars($_SESSION['client']['prenom']),
						"TXT_EMAIL_CLIENT" => htmlspecialchars($_SESSION['client']['mail']),
						"TXT_TEL_CLIENT" => htmlspecialchars($_SESSION['client']['tel_fixe']),
						"TXT_PORT_CLIENT" => htmlspecialchars($_SESSION['client']['tel_port']),
						"TXT_ADRESSE_CLIENT" => htmlspecialchars($_SESSION['client']['adresse']),
						"TXT_CODE_POST_CLIENT" => htmlspecialchars($_SESSION['client']['cp']),
						"TXT_VILLE_CLIENT" => htmlspecialchars($_SESSION['client']['ville'])
						)
				 );
			}
		}
	}
	else
	{
		$ret = query("SELECT id_pays, civilite, nom, prenom, adresse, code_postal, ville, mail, tel_fixe, tel_port FROM aeroport_client WHERE id_client = '" . $_SESSION['client']['id_client'] . "'");
		$row = $ret->fetch();
		
		$tpl->set(array(
						"CIV_CHERCHE" => $row['civilite'],
						"PAYS_CHERCHE" => $row['id_pays'],
                        "IND_FIXE_CHERCHE" => $_SESSION['client']['ind_fixe'],
                        "IND_PORT_CHERCHE" => $_SESSION['client']['ind_port'],
						"TXT_NOM_CLIENT" => htmlspecialchars($row['nom']),
						"TXT_PRENOM_CLIENT" => htmlspecialchars($row['prenom']),
						"TXT_EMAIL_CLIENT" => htmlspecialchars($row['mail']),
						"TXT_TEL_CLIENT" => htmlspecialchars($row['tel_fixe']),
						"TXT_PORT_CLIENT" => htmlspecialchars($row['tel_port']),
						"TXT_ADRESSE_CLIENT" => htmlspecialchars($row['adresse']),
						"TXT_CODE_POST_CLIENT" => htmlspecialchars($row['code_postal']),
						"TXT_VILLE_CLIENT" => htmlspecialchars($row['ville'])
						)
				 );
	}
	
	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_info,
					"TITRE" => $info,
					"LANG" => $_SESSION['lang'],
					"OBLIGATOIRE" => $obligatoire,
					"OBLIGATOIRE_2" => $obligatoire_2,
					"BTN_ENVOYER" => $btn_envoyer,
					"BTN_RAZ" => $btn_raz,
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
					"CLASS_ERREUR" => $_SESSION['class_info'],
					"ERREUR" => $_SESSION['erreur_info'],
					"SPRY_VIDE" => $spry_valeur_requise,
					"SPRY_FORMAT" => $spry_format,
					"EXPLICATION" => $explication_donnees_perso,
					"EMAIL" => $eemail,
                    "WARNING_TEL" => $warning_tel,
                    "INDICATIF" => $indicatif,
                    "EXPLI_INDICATIF" => $expli_indicatif,
					"AIDE_EMAIL" => $expli_email,
					"AUTRES_INFOS" => $autres_infos,
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
					"POINTS_PRISE" => $points_prise
					)
			 );
	
	
	$tpl->parse('aeroport/client/info.html');

?>
