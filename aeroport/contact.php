<?php

	session_start();

	require_once('includes/tpl_base.php');
	require_once(dirname(__FILE__) . '/../libs/Mail.php');
	
	
	// le fil d'ariane
	
	$tab_ariane = array(
						array(
							'ARIANE' => $ariane_accueil,
							'LIEN' => 'index.html'
							),
						array(
							'ARIANE' => $ariane_contact,
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
	
	
	$erreur = "";
	
	$tab_contact = array(
						array('RAISON' => $txt_raison_1),
						array('RAISON' => $txt_raison_2),
						array('RAISON' => $txt_raison_3)
						);
	
	foreach($tab_contact as $tab)
	{
		$tpl->setBlock('contact', 'RAISON', $tab['RAISON']);
	}
	
	
	$tab_moyen = array(
					array('MOYEN' => $txt_moyen_tel),
					array('MOYEN' => $txt_moyen_port),
					array('MOYEN' => $txt_moyen_courrier)
					);
					
	foreach($tab_moyen as $tab)
	{
		$tpl->setBlock('moyen', 'CONTACT', $tab['MOYEN']);
	}
	
	
	$tab_raison = array(
					array("code_raison" => 0, "raison" => $raison_contact_0),
					array("code_raison" => 1, "raison" => $raison_contact_1),
					array("code_raison" => 2, "raison" => $raison_contact_2)
					);
					
	foreach($tab_raison as $tab)
	{
		$tpl->setBlock('raison', array(
										'CODE_RAISON' => $tab['code_raison'],
										'RAISON' => $tab['raison']
										)
				);
	}
								
	
	
	$nom = "";
	$prenom = "";
	$mail = "";
	$message = "";
	$raison = "";
	
	$_SESSION['class_contact'] = "erreur";
	
	if(isset($_SESSION['erreur_contact_ok']) && !$_SESSION['erreur_contact_ok'])
		$_SESSION['erreur_contact'] = "";
	else
		$_SESSION['class_contact'] = "valide";
		
	$_SESSION['erreur_contact_ok'] = false;
	
	if(isset($_POST['contact']))
	{		
		$nom = trim($_POST['nom']);
		$prenom = trim($_POST['prenom']);
		$mail = trim($_POST['mail']);
		$raison = intval($_POST['raison']);
		$message = trim($_POST['message']);
		
		if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($message))
		{
			if(is_mail_valide($mail))
			{
				
				$tmp = "raison_contact_" . $raison;
				
				$sujet = "Formulaire de contact : " . $$tmp;
				
				$mesg = "Nom : " . $nom . "<br />Prénom : " . $prenom . "<br />Email : " . $mail . "<br /><br />" . $message;
				
				$mailer = new Mail();
				
				$mailer->Subject = $sujet;
				$mailer->Body = "<html><head></head><body>" . $mesg . "</body></html>";
				$mailer->AddAddress("info@alsace-navette.com");
				$mailer->ClearReplyTos();
				$mailer->AddReplyTo($mail, $nom . " " . $prenom);

				if($mailer->Send())
				{								
					$_SESSION['erreur_contact'] = $contact_ok;
					$_SESSION['class_contact'] = "valide";
					$_SESSION['erreur_contact_ok'] = true;
					
					header('Location: contact.html');
					exit();
				}
				else
					$_SESSION['erreur_contact'] = $contact_erreur;
			}
			else
			{
				$mail = "";
				$_SESSION['erreur_contact'] = $mail_invalide;
			}
		}
		else
			$_SESSION['erreur_contact'] = $erreur_champ_vide;


		unset($_POST['contact']);
	}
	
	
	$tpl->set(array(
					"TITRE_PAGE" => $titre_page_contact,
					"TITRE_CONTACT" => $contact,
					"TITRE_FORMULAIRE" => $ariane_contact,
					"TXT_CONTACT" => $txt_contact,
					"MOYEN_CONTACT" => $moyen_contact,
					"NOM_CONTACT" => $nom_client,
					"PRENOM_CONTACT" => $prenom_client,
					"RAISON_CONTACT" => $raison_contact,
					"BTN_ENVOYER" => $btn_envoyer,
					"OBLIGATOIRE" => $obligatoire,
					"TXT_NOM_CONTACT" => html_entity_decode($nom),
					"TXT_PRENOM_CONTACT" => html_entity_decode($prenom),
					"TXT_MAIL_CONTACT" => html_entity_decode($mail),
					"TXT_MESSAGE_CONTACT" => html_entity_decode($message),
					"RAISON_CHERCHE" => $raison,
					"CLASS_ERREUR" => $_SESSION['class_contact'],
					"ERREUR" => (isset($_SESSION['erreur_contact'])) ? $_SESSION['erreur_contact'] : ""
					)
				);
				
	$tpl->parse("aeroport/contact/contact.html");


?>
