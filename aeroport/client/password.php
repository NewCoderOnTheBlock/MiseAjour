<?php

	session_start();
	
	if(!isset($_GET['action']))
	{
		header('Location: client.php?p='.$_SERVER['REQUEST_URI']);
		exit();
	}
	
	if(!$_SESSION['logger'] && $_GET['action'] != "2")
	{
		header('Location: client.php?p'.$_SERVER['REQUEST_URI']);
		exit();
	}
	
	require_once('../includes/tpl_base.php');
	require_once(dirname(__FILE__) . '/../../libs/Mail.php');
	
	
	// le fil d'ariane
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.php'
							),
						array(
							'ARIANE' => $ariane_pass,
							'LIEN' => 'client/password.php?action=' . intval($_GET['action'])				
							),
						array(
							'ARIANE' => (intval($_GET['action']) == 1) ? $ariane_changement_pass : $ariane_new_password,
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
	

	$adresse = "";
	
	$_SESSION['class_pass'] = "erreur";
		
	if(isset($_SESSION['erreur_pass_ok']) && !$_SESSION['erreur_pass_ok'])
		$_SESSION['erreur_pass'] = "";
	else
		$_SESSION['class_pass'] = "valide";
		
	$_SESSION['erreur_pass_ok'] = false;
	
	
	if(isset($_POST['pass']))
	{					
		if(intval($_GET['action']) == 2) // mot de passe perdu
		{	
			$mail = $_POST['adresse_mail'];
	
			if(!empty($mail))
			{
				$sql = "SELECT civilite, nom, prenom, adresse, code_postal, ville, mail, tel_fixe, tel_port FROM aeroport_client WHERE mail = '" . $mail . "'";

				$ret = query($sql);
				$ret_val = $ret->fetch();
	
				if($ret->rowCount() == 1)
				{
					/*
						Ajout KEMPF
						Modification du mot de passe en fonction du prénom + 2 chiffres aléatoires
					*/
					
					$prenom = $ret_val['prenom'];
					
					$prenom = stripAccents($prenom);
					
					$prenom = strtolower($prenom);
					
					$prenom = str_replace(array("-", ".", " ", "'"), "", $prenom);
					
					$code = $prenom.rand(1, 9).rand(1, 9);
					
					$ret->closeCursor();
					
					$sql = "UPDATE aeroport_client SET mdp = '" . $code . "' WHERE mail = '" . $mail . "'";
					
					$message = '<html><head></head><body>' . $debut_mail_pass . $code . $fin_mail_pass . '</body></html>';	
					
					$mailer = new Mail();
					
					$mailer->Subject = $object_new_pass;
					$mailer->Body = $message;
					$mailer->AddAddress($mail);

					if($mailer->Send())
					{
						$_SESSION['erreur_pass'] = $valide_new_pass;
						$_SESSION['class_pass'] = "valide";
						$_SESSION['erreur_pass_ok'] = true;
						$_SESSION['redirect'] = false;
						
						write($sql);
						
						header('Location: password.php?action=2');
						exit();
					}
					else
					{
						$_SESSION['redirect'] = false;
						$_SESSION['erreur_pass'] = $erreur_envoie_mail;
					}
				}
				else
				{
					$ret->closeCursor();
					
					$_SESSION['redirect'] = false;
					$_SESSION['erreur_pass'] = $erreur_client_inexistant;
				}
			}
			else // un champ n'est pas remplit
			{
				$_SESSION['redirect'] = false;
				$_SESSION['erreur_pass'] = $erreur_champ_vide;
			}
				
			unset($_POST['pass']);
		}
		else // nouveau mot de passe
		{
			$anc_pass = $_POST['anc_mdp'];
			$new_passwd = $_POST['new_pass'];
			$new_passwd_confirm = $_POST['new_pass_confirm'];
			
			if(!empty($anc_pass) && !empty($new_passwd) && !empty($new_passwd_confirm))
			{
				$verif_pass = query("SELECT mdp FROM aeroport_client WHERE id_client = '" . $_SESSION['client']['id_client'] . "' AND mdp = '" . sha1($anc_pass) . "' OR mdp = '" . $anc_pass . "'");
 
				if($verif_pass->rowCount() != 0)
				{
					if($new_passwd == $new_passwd_confirm)
					{					
						$sql = "UPDATE aeroport_client SET mdp = '" . $new_passwd . "' WHERE id_client = '" . $_SESSION['client']['id_client'] . "'";
						
						$message = "<html><head></head><body>" . $debut_mail_passwd . $new_passwd . $fin_mail_pass . "</body></html>";
						
						$mailer = new Mail();
					
						$mailer->Subject = $object_new_pass;
						$mailer->Body = $message;
						$mailer->AddAddress($_SESSION['client']['mail']);
	
						if($mailer->Send())
						{
							$_SESSION['erreur_pass'] = $valide_new_passwd;
							$_SESSION['class_pass'] = "valide";
							$_SESSION['erreur_pass_ok'] = true;
							$_SESSION['redirect'] = true;
							
							write($sql);
							
							header('Location: password.php?action=1');
							exit();
						}
						else
						{
							$_SESSION['redirect'] = false;
							$_SESSION['erreur_pass'] = $erreur_envoie_mail;
						}
					}
					else
					{
						$_SESSION['redirect'] = false;
						$_SESSION['erreur_pass'] = $erreur_pass_correspondance;
					}
				}
				else
				{
					$_SESSION['redirect'] = false;
					$_SESSION['erreur_pass'] = $erreur_ancien_pass;
				}
			}
			else
			{
				$_SESSION['redirect'] = false;
				$_SESSION['erreur_pass'] = $erreur_champ_vide;
			}
		}
	}
	
	
	$explication = "";
	
	if(intval($_GET['action']) == 1) // nouveau mot de passe
		$explication = $explication_nouveau_mot_de_passe;
	else // mot de passe perdu
		$explication = $explication_mot_de_passe_perdu;
	
	
	
	if(isset($_SESSION['redirect']))
		$redirect = $_SESSION['redirect'];
	else
		$redirect = false;
		
	$tpl->set(array(
					"TITRE_PAGE" => (intval($_GET['action']) == 1) ? $titre_page_changer_pass : $titre_page_nouveau_pass,
					"TITRE_PASSWORD" => (intval($_GET['action']) == 1) ? $changer_pass : $nouveau_pass,
					"ACTION" => intval($_GET['action']),
					"REDIRECTION" => $redirect,
					"ADRESSE_MAIL" => $email,
					"BTN_ENVOYER" => $btn_envoyer,
					"CLASS_ERREUR" => $_SESSION['class_pass'],
					"ERREUR" => $_SESSION['erreur_pass'],
					"ANCIEN_MDP" => $ancien_mdp,
					"NEW_PASS" => $new_pass,
					"NEW_PASS_CONFIRM" => $new_pass_confirm,
					"SPRY_VIDE" => $spry_valeur_requise,
					"SPRY_CORRESPONDANCE" => $spry_correspondance,
					"SPRY_FORMAT" => $spry_format,
					"EXPLICATION" => $explication
					)
			 );
	
	$_SESSION['erreur_pass'] = "";
	$_SESSION['class_pass'] = "";

			 
	$tpl->parse("aeroport/client/password.html");

?>