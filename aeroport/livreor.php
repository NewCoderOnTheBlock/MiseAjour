<?php
	session_start();

	require_once('includes/tpl_base.php');
	
	
	// le fil d'ariane
	
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $ariane_livreor,
							'LIEN' => 'livreor.html'
							),
						array(
							'ARIANE' => $ariane_liste_livreor,
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
	
	$pseudo = "";
	$message = "";
	
	
	$_SESSION['class_livre'] = "erreur";
	
	if(isset($_SESSION['erreur_livre_ok']) && !$_SESSION['erreur_livre_ok'])
		$_SESSION['erreur_livre'] = "";
	else
		$_SESSION['class_livre'] = "valide";
		
	$_SESSION['erreur_livre_ok'] = false;
	
	if(isset($_POST['livreor']))
	{
		$pseudo = trim(addslashes($_POST['pseudo']));
		$message = trim(addslashes($_POST['message']));
		
		if(!empty($_POST['pseudo']) && !empty($_POST['message']) && !empty($_POST['code']))
		{
			if($_SESSION['code_captcha'] == trim($_POST['code']))
			{
				$ip = get_ip();
				
				$sql = "INSERT INTO
							aeroport_livreor (login, message, date, ip)
						VALUES ('" . $pseudo . "', '" . $message . "', NOW(), '" . $ip . "')";

				write($sql);
				
				$_SESSION['erreur_livre'] = $valide_livreor;
				$_SESSION['class_livre'] = "valide";
				$_SESSION['erreur_livre_ok'] = true;
					
				header('Location: livreor.html');
				exit();
			}
			else
				$_SESSION['erreur_livre'] = $erreur_code;
		}
		else // un champ n'est pas remplit
			$_SESSION['erreur_livre'] = $erreur_champ_vide;
			
		unset($_POST['livreor']);
	}
	
	
	$nb_message_livreor = get_nb_message_livreor();
	
		
	$tpl->set(array(
					"TITRE_PAGE" => $titre_page_livreor,
					"INTRO" => $intro_livreor,
					"TITRE_LIVREOR" => $ariane_livreor,
					"PSEUDO_LIVREOR" => $pseudo_livreor,
					"MESSAGE_LIVREOR" => $message_livreor,
					"TXT_CAPTCHA" => $txt_captcha,
					"NOUVEAU_CAPTCHA" => $nouveau_captcha,
					"SESSID" => session_id(),
					"BTN_ENVOYER" => $btn_envoyer,
					"TXT_NB_MESSAGE" => $txt_nb_message,
					"NB_MESSAGE" => $nb_message_livreor,
					"LIVREOR_PAR" => $livreor_par,
					"LIVREOR_LE" => $livreor_le,
					"AUCUN_MESSAGE" => $aucun_message,
					"PAGE_PRECEDENT" => $page_precedent,
					"PAGE_SUIVANT" => $page_suivant,
					"PSEUDO" => html_entity_decode(stripslashes($pseudo)),
					"MESSAGE" => str_replace('<br />', '', htmlspecialchars_decode(stripslashes($message))),
					"CLASS_ERREUR" => $_SESSION['class_livre'],
					"ERREUR" => (isset($_SESSION['erreur_livre'])) ? $_SESSION['erreur_livre'] : ""
					)
			);
			
	
	$nb_par_page = 10;
	$nb_pages = ceil($nb_message_livreor / $nb_par_page);
	
	$nb_pages = ($nb_pages == 0) ? 1 : $nb_pages;

	
	$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? intval($_GET['page']) : 1;
	
	$page = ($page > $nb_pages) ? 1 : $page;
	
	$deb = ($page - 1) * $nb_par_page; 
	$fin = $nb_par_page;
	
	$p_courante = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
	
	$tab_pagination = pagination($p_courante, $nb_pages);

	for($i = 0; $i < count($tab_pagination); $i++)	
		$tpl->setBlock('pagination', 'PAGE', $tab_pagination[$i]);

		
	$tpl->set(array(
				"PAGE" => $page,
				"PRECEDENT" => $page - 1,
				"SUIVANT" => $page + 1,
				"NB_PAGE" => $nb_pages
				)
			);
		
	foreach(get_message_livreor($deb, $fin) as $tab)
	{
		$tpl->setBlock('message', array(
									'PSEUDO' => htmlspecialchars($tab['LOGIN'], ENT_COMPAT, "UTF-8"),
									'MESSAGE' => htmlspecialchars($tab['MESSAGE'], ENT_COMPAT, "UTF-8"),
									'DATE' => $tab['DATE']
									)
						);
	}
			
	
	$tpl->parse("aeroport/livreor/livreor.html");

?>