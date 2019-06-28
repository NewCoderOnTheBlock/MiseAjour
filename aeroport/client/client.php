<?php
	session_start();

	if($_SESSION['logger'] && $_SESSION['client']['est_admin'] == '0')
	{
		header('Location: ../index.php');
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
							'ARIANE' => $ariane_client,
							'LIEN' => 'client/client.html'
							),
						array(
							'ARIANE' => $ariane_authentification,
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
		
		
		
	$mail = "";
	$passs = "";
	$p = htmlspecialchars($_GET['p']);
	
	
	$_SESSION['class_client'] = "erreur";
	
	if(isset($_SESSION['erreur_client_ok']) && !$_SESSION['erreur_client_ok'])
		$_SESSION['erreur_client'] = "";
	else
		$_SESSION['class_client'] = "valide";
		
	$_SESSION['erreur_client_ok'] = false;

	if(isset($_POST['deja_client']))
	{
		$mail = trim($_POST['mail']);
		$passs = addslashes($_POST['pass']);

		if(!empty($_POST['mail']) && !empty($_POST['pass']))
		{
			$sql = "SELECT id_client, id_pays, civilite, nom, prenom, adresse, code_postal, ville, mail, tel_fixe, tel_port, est_admin, nb_alea, ind_fixe, ind_port, professionnel FROM aeroport_client WHERE mail = '" . $mail . "' AND (mdp = '" . sha1($passs) . "' OR mdp = '" . $passs . "')";

			$ret = query($sql);

			if($ret->rowCount() == 1)
			{
				$row = $ret->fetch();
				
				if($_SESSION['client']['est_admin'] == '0')
				{
					$_SESSION['logger'] = true;
					$_SESSION['client']['id_client'] = $row['id_client'];
					$_SESSION['client']['civilite'] = $row['civilite'];
					$_SESSION['client']['nom'] = $row['nom'];
					$_SESSION['client']['prenom'] = $row['prenom'];
					$_SESSION['client']['mail'] =  $row['mail'];
					$_SESSION['client']['tel_fixe'] = $row['tel_fixe'];
					$_SESSION['client']['tel_port'] = $row['tel_port'];
                    $_SESSION['client']['ind_fixe'] = $row['ind_fixe'];
					$_SESSION['client']['ind_port'] = $row['ind_port'];
					$_SESSION['client']['adresse'] = $row['adresse'];
					$_SESSION['client']['cp'] = $row['code_postal'];
					$_SESSION['client']['ville'] = $row['ville'];
					$_SESSION['client']['pays'] = $row['id_pays'];
					$_SESSION['client']['est_admin'] = $row['est_admin'];
                    $_SESSION['client']['nb_alea'] = $row['nb_alea'];
                    $_SESSION['client']['pro'] = $row['professionnel'];
					// KEMPF : Fidelité
					$_SESSION['client']['points_fidelite'] = get_mes_points_fidelite($row['id_client']);
					$_SESSION['client']['est_fidele'] = est_fidele($row['id_client']);
					
					$ret->closeCursor();
					
					write("UPDATE aeroport_client SET ip = '" . get_ip() . "' WHERE id_client = '" . $_SESSION['client']['id_client'] . "'");
					
					if($_SESSION['client']['est_admin'] == '1')
					{
						header('Location: ../index.php');
						
						exit();
					}
				}
				else  // connexion en client tout en étant admin
				{
					if($row['id_client'] == $_SESSION['client']['id_client'])
					{
						header('Location: ../index.php');
						exit();
					}
					
					$_SESSION['est_admin_client'] = '1';
					
					$_SESSION['client']['id_client'] = $row['id_client'];
					$_SESSION['client']['civilite'] = $row['civilite'];
					$_SESSION['client']['nom'] = $row['nom'];
					$_SESSION['client']['prenom'] = $row['prenom'];
					$_SESSION['client']['mail'] =  $row['mail'];
					$_SESSION['client']['tel_fixe'] = $row['tel_fixe'];
					$_SESSION['client']['tel_port'] = $row['tel_port'];
                    $_SESSION['client']['ind_fixe'] = $row['ind_fixe'];
					$_SESSION['client']['ind_port'] = $row['ind_port'];
					$_SESSION['client']['adresse'] = $row['adresse'];
					$_SESSION['client']['cp'] = $row['code_postal'];
					$_SESSION['client']['ville'] = $row['ville'];
					$_SESSION['client']['pays'] = $row['id_pays'];
                    $_SESSION['client']['nb_alea'] = $row['nb_alea'];
                    $_SESSION['client']['pro'] = $row['professionnel'];
				}
				
				
				
				if($_SESSION['debut_resa'] == "1")
				{
					header('Location: ../reservation/reservation.php');
				}
				elseif($_SESSION['demande_reservation']['connection'] == "1")
				{
					header('Location: ../demande_reservation.php');
				}
				else
				{
					header('Location: http://'.$_SERVER['SERVER_NAME'].$p);
				}	
				exit();
			}
			else
			{
				$ret->closeCursor();
				
				$_SESSION['erreur_client'] = $erreur_client_login;
			}
		}
		else // un champ n'est pas rempli
			$_SESSION['erreur_client'] = $erreur_champ_vide;
			
		unset($_POST['deja_client']);
	}

	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_page_client,
					"DEJA_CLIENT_TXT" => $deja_client_txt,
					"BTN_ENVOYER" => $btn_envoyer,
					"EMAIL" => $email,
					"PASSWD" => $passwd,
					"MDP_OUBLIE" => $mdp_oublie,
					"CLASS_ERREUR" => $_SESSION['class_client'],
					"ERREUR" => (isset($_SESSION['erreur_client'])) ? $_SESSION['erreur_client'] : "",
					"ERREUR_PASS" => (isset($_SESSION['erreur_pass'])) ? $_SESSION['erreur_pass'] : "",
					"CLASS_PASS" => (isset($_SESSION['class_pass'])) ? $_SESSION['class_pass'] : "",
					"SPRY_FORMAT" => $spry_format,
					"SPRY_VIDE" => $spry_valeur_requise,
					"EXPLICATION" => $explication_connexion,
					"EST_ADMIN" => $_SESSION['client']['est_admin'],
					"PAGE" => $p
					)
			 );

	$_SESSION['erreur_pass'] = "";
	$_SESSION['class_pass'] = "";

	$tpl->parse("aeroport/client/client.html");

?>