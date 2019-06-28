<?php
	session_start();
	
	require_once('../includes/tpl_base.php');
	require_once('./ressource.php');
	
	unset($_SESSION['fin_resa']);
	
	unset($_SESSION['debut_resa']);
	
	if(isset($_POST['res_2']) || isset($_GET['res_2']))
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
		
		
		// données client
		
		
		
		if(!$_SESSION['logger'] || ($_SESSION['client']['est_admin'] == "1" && $_SESSION['est_admin_client'] == '0'))
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

                if(substr($_SESSION['client']['tel_port'], 0, 2) == "06")
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
		}
		
		
		
		// vérification si déjà client
		$bool_deja_client = false;		
		if((!$_SESSION['logger'] || ($_SESSION['client']['est_admin'] == "1" && $_SESSION['est_admin_client'] == '0')) && trouve($_SESSION['client']['mail']))
		{
			header('Location: info_client.php?res_1=1&client=1');
			exit();
		}

        header("Location: choix-navette_aller.html?res_2_1=1");
	}
	else
	{
		header('Location: ../index.html');
		exit();
	}
						
?>
