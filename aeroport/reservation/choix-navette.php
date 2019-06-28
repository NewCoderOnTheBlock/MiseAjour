<?php
session_start();

if(isset($_GET["action"]) && ($_GET["action"]=='verif')){	
	if(($_POST['lst_heure_depart']!='0') && ($_POST['lst_fixe_depart']!='0')){	
		$_SESSION['alert']='		
			<script language="javascript">;
			alert("Vous ne pouvez pas choisir a la fois un Horraires fixes et a la fois un Horaires a la demande veuillez en choisir un")
			</script>;
		';

		header('Location: ../index.php');
		exit();	
	}
	
	if(($_POST['lst_heure_retour']!='0') && ($_POST['lst_fixe_retour']!='0')){
		$_SESSION['alert']='		
			<script language="javascript">;
			alert("Vous ne pouvez pas choisir a la fois un Horraires fixes et a la fois un Horaires a la demande veuillez en choisir un")
			</script>;
		';

		header('Location: ../index.php');
		exit();
	}
}

	require_once('../includes/tpl_base.php');
	require_once('./ressource.php');
	
	unset($_SESSION['fin_resa']);
	unset($_SESSION['debut_resa']);
	
	if(isset($_POST['type_trajet']))
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
		
		$_SESSION['client']['mail'] = $_POST['email'];
		$_SESSION['trajet']['type_trajet'] = intval(trim($_POST['type_trajet']));
		$_SESSION['trajet']['depart'] = intval(trim($_POST['lst_trajet_depart']));
		$_SESSION['trajet']['dest'] = intval(trim($_POST['lst_trajet_arrive']));
		$_SESSION['trajet']['retour'] = $_SESSION['trajet']['dest'];
		$_SESSION['client']['mail'] = htmlspecialchars(trim($_POST['email']));
		if($_POST['lst_heure_depart'] == '0' && $_POST['lst_fixe_depart'] != "0")
		{
			$type_fixe = ($_SESSION['trajet']['depart'] == 100) ? "depart" : "retour";
			
			$_SESSION['trajet']['heure_depart'] = get_heure(intval($_POST['lst_fixe_depart']), $type_fixe);
			$_SESSION['trajet']['depart_fixe'] = intval($_POST['lst_fixe_depart']);
			$_SESSION['trajet']['heure_depart_fixe'] = intval($_POST['lst_fixe_depart']);
			$_SESSION['trajet']['bool_depart_fixe'] = true;
		}
		else
		{
			$_SESSION['trajet']['heure_depart'] = trim($_POST['lst_heure_depart']);
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
			else
			{
				$_SESSION['trajet']['heure_retour'] = trim($_POST['lst_heure_retour']);
			}
		}
		
		$_SESSION['trajet']['pt_rass_aller'] = intval(trim($_POST['pt_rassemblement_aller']));
		$_SESSION['trajet']['pt_rass_retour'] = intval(trim($_POST['pt_rassemblement_retour']));
		$_SESSION['trajet']['rass_adresse_aller'] = htmlspecialchars(trim($_POST['rass_adresse_aller']), ENT_COMPAT, "UTF-8");
		$_SESSION['trajet']['rass_cp_aller'] = htmlspecialchars(trim($_POST['rass_cp_aller']), ENT_COMPAT, "UTF-8");
		$_SESSION['trajet']['rass_ville_aller'] = htmlspecialchars(trim($_POST['rass_ville_aller']), ENT_COMPAT, "UTF-8");
		$_SESSION['trajet']['rass_adresse_retour'] = htmlspecialchars(trim($_POST['rass_adresse_retour']), ENT_COMPAT, "UTF-8");
		$_SESSION['trajet']['rass_cp_retour'] = htmlspecialchars(trim($_POST['rass_cp_retour']), ENT_COMPAT, "UTF-8");
		$_SESSION['trajet']['rass_ville_retour'] = htmlspecialchars(trim($_POST['rass_ville_retour']), ENT_COMPAT, "UTF-8");
		
		if($_SESSION['trajet']['depart'] == 7 || $_SESSION['trajet']['dest'] == 7)
		{
			$_SESSION['trajet']['pt_rass_aller'] = 4;
			$_SESSION['trajet']['pt_rass_retour'] = 4;
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
			
			
		
		if ($_SESSION['trajet']['depart'] == 100)
		{
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
			$_SESSION['trajet']['passager_adulte_retour'] = intval(trim($_POST['lst_passager_adulte_retour']));
			$_SESSION['trajet']['passager_enfant_retour'] = intval(trim($_POST['lst_passager_enfant_retour']));
		}
		else
		{
			$_SESSION['trajet']['passager_adulte_retour'] = 0;
			$_SESSION['trajet']['passager_enfant_retour'] = 0;
		}
		
		
		// données client
		
		
		
		/*if(!$_SESSION['logger'] || ($_SESSION['client']['est_admin'] == "1" && $_SESSION['est_admin_client'] == '0'))
		{
			$_SESSION['client']['civilite'] = trim($_POST['lst_civ']);
			$_SESSION['client']['nom'] = htmlspecialchars(trim($_POST['nom_client']));
			$_SESSION['client']['prenom'] = htmlspecialchars(trim($_POST['prenom_client']));
			$_SESSION['client']['mail'] = htmlspecialchars(trim($_POST['email_client']));
            $_SESSION['client']['pro'] = "0";

            if(!empty($_POST['tel_client']))
            {
                $_SESSION['client']['ind_fixe'] = intval($_POST['indicatif_fixe']);
                $_SESSION['client']['tel_fixe'] = trim($_POST['tel_client']);
            }
            else
            {
                $_SESSION['client']['tel_fixe'] = "";
                $_SESSION['client']['ind_fixe'] = "";
            }

            if(!empty($_POST['port_client']))
            {
                $_SESSION['client']['ind_port'] = intval($_POST['indicatif_port']);
                $_SESSION['client']['tel_port'] = trim($_POST['port_client']);

                if(substr($_SESSION['client']['tel_port'], 0, 2) == "06" || substr($_SESSION['client']['tel_port'], 0, 2) == "07")
                    $_SESSION['client']['tel_port'] = substr($_SESSION['client']['tel_port'], 1);
            }
            else
            {
                $_SESSION['client']['ind_port'] = "";
                $_SESSION['client']['tel_port'] = "";
            }


			$_SESSION['client']['adresse'] = htmlspecialchars(trim($_POST['adresse_client']));
			$_SESSION['client']['cp'] = htmlspecialchars(trim($_POST['code_post_client']));
			$_SESSION['client']['ville'] = htmlspecialchars(trim($_POST['ville_client']));
			$_SESSION['client']['pays'] = intval(trim($_POST['pays_client']));
		}
		
		
		if(strlen($_SESSION['client']['nom']) <= 0 || strlen($_SESSION['client']['prenom']) <= 0 || strlen($_SESSION['client']['mail']) <= 0 || strlen($_SESSION['client']['ville']) <= 0)
		{
			$_SESSION['erreur_erreur_ok'] = false;
			$_SESSION['erreur_erreur'] = $erreur_champ_vide;
			
			header('Location: info_client.php?res_1=1');
			exit();
		}
		else
		{
			if(strlen($_SESSION['client']['tel_fixe']) <= 0 && strlen($_SESSION['client']['tel_port']) <= 0)
			{
				$_SESSION['erreur_erreur_ok'] = false;
				$_SESSION['erreur_erreur'] = $erreur_champ_vide;
				
				header('Location: info_client.php?res_1=1');
				exit();
			}
		}*/
		
		
		
		// vérification si déjà client
		$bool_deja_client = false;		
		/*if((!$_SESSION['logger'] || ($_SESSION['client']['est_admin'] == "1" && $_SESSION['est_admin_client'] == '0')) && trouve($_SESSION['client']['mail']))
		{
			header('Location: info_client.php?res_1=1&client=1');
			exit();
		}*/

        header("Location: ../navettes_disponibles.php");
	}
	else
	{
		header('Location: ../index.php');
		exit();
	}
						
?>

