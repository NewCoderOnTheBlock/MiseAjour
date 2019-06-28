<?php
	
	/*
		Fichier qui va traiter l'après-paiement d'une réservation
		Gestion de la facture, de l'enregistrement dans la base de données, de l'envoie de SMS et Email
	*/
	
	$dirname = dirname(__FILE__);
	
	include("./fonctionConnection.php");
	require_once($dirname . "/../../libs/config.php");	
	require_once($dirname . "/../../libs/db.php");
	require_once($dirname . "/../../includes/fonctions.php");
	
	/*
		Ajout KEMPF
		Fonction qui génère la facture
		Ajout dans la BDD + renvoi de l'ID de la facture pour l'envoi dans le Mail
		Données extraites de la table aeroport_paypal
	*/
	
	function ajouterFacture($id_paypal, $lang, $id_client = 0)
	{
		if ($id_paypal != 0){
			// On récupère l'ID de la facture et on le remet à jour
			$id_facture = intval(get_option("id_max_facture"));
			set_option("id_max_facture", ($id_facture + 1));
			
			// TVA
			$fac_tva = intval(get_option("tva"));
			
			// Récupération de la majoration à la demande
			$taux_demande = intval(get_option("maj_surcout_demande"));
			
			// Récupération de la majoration à domicile
			$taux_domicile = intval(get_option("maj_dom"));
		
			// Récupère toutes les données pour la facture		
			$req = query("	SELECT *,
							DATE_FORMAT(date_depart, '%d-%m-%Y') AS date_aller_f,
							DATE_FORMAT(date_retour, '%d-%m-%Y') AS date_retour_f,
							DATE_FORMAT(date_depart, '%H:%i') AS heure_aller_f,
							DATE_FORMAT(date_retour, '%H:%i') AS heure_retour_f
							FROM aeroport_paypal
							WHERE id_paypal = '" . $id_paypal . "'");
							
			$r = $req->fetch();
			
			// Récupération des lieux
			$fac_lieu_1_aller = get_lieu(intval($r['id_depart']));
			$fac_lieu_2_aller = get_lieu(intval($r['id_dest']));
			
			// Initialisation des variables qui seront utilisées dans la facture
			$fac_civilite = $r['civilite'];
			$fac_nom = addslashes($r['nom']);
			$fac_prenom = addslashes($r['prenom']);
			$fac_mail = addslashes($r['email']);
			$fac_prix_total = $r['prix'];
			$fac_date_aller = $r['date_aller_f'];
			$fac_prix_aller = $r['prix_aller'];
			$fac_demande_aller = ($r['depart_fixe'] == 0) ? $taux_demande : 0;
			$fac_domicile_aller = ($r['id_pt_rass_aller'] == 4) ? $taux_domicile : 0;
			$fac_date_retour = $r['date_retour_f'];
			$fac_prix_retour = $r['prix_retour'];
			$fac_lieu_1_retour = $fac_lieu_2_aller;
			$fac_lieu_2_retour = $fac_lieu_1_aller;
			$fac_demande_retour = ($r['retour_fixe'] == 0) ? $taux_demande : 0;
			$fac_domicile_retour = ($r['id_pt_rass_retour'] == 4) ? $taux_domicile : 0;
			
			$fac_nb_pers_aller = $r['passager_adulte_aller'];
			$fac_nb_pers_retour = $r['passager_adulte_aller'];
			
			if ($r['is_der_min'] == "24"){
				$fac_der_minute = intval(get_option("maj_24"));
			}elseif ($r['is_der_min'] == "72"){
				$fac_der_minute = intval(get_option("maj_72"));
			}
			
			/* 
				Gestion si ce sont des trajets de nuit
			*/
			$fac_nuit_aller = (est_horaire_nuit($r['heure_aller_f'])) ? 1 : 0;
			$fac_nuit_retour = (est_horaire_nuit($r['heure_retour_f'])) ? 1 : 0;
			
			
			$fac_langue = $lang;
			$fac_valide = 1;
			$fac_attente = 0;
			
			$req->closeCursor();
			
			$sql = "INSERT INTO
						aeroport_facture
					VALUES (
						'" . $id_facture . "',
						'" . $fac_civilite . "', 
						'" . $fac_nom . "', 
						'" . $fac_prenom . "', 
						'" . $fac_mail . "', 
						'" . $fac_prix_total . "',
						'" . $fac_tva . "',
						'" . $fac_date_aller . "',
						'" . $fac_prix_aller . "',
						'" . $fac_lieu_1_aller . "',
						'" . $fac_lieu_2_aller . "',
						'" . $fac_demande_aller . "',
						'" . $fac_domicile_aller . "',
						'" . $fac_date_retour . "',
						'" . $fac_prix_retour . "',
						'" . $fac_lieu_1_retour . "',
						'" . $fac_lieu_2_retour . "',
						'" . $fac_demande_retour . "',
						'" . $fac_domicile_retour . "',
						'" . $fac_der_minute . "',
						'" . date('d-m-Y') . "',
						'" . $fac_nb_pers_aller . "',
						'" . $fac_nb_pers_retour . "',
						'" . $fac_nuit_aller . "',
						'" . $fac_nuit_retour . "',
						'" . $fac_langue . "',
						'',
						'" . $fac_valide . "',
						'" . $fac_attente. "')";
						
			// Insertion de la facture dans la base de données
			
			write($sql);
			
			/*
				On en profite également pour mettre à jour les points de 
				fidelité
				/!\ Le système n'est pas en place, cette fonction n'aura aucune répercution
			*/
			ajouter_points_fidelite(intval($id_client), $fac_prix_total);
			
			return $id_facture;
		}else{
			/* 
				Si l'ID PayPal rentré est égal à 0, 
				c'est que la réservation différée qui est
				à son origine est trop ancienne.
				(Et donc, il n'y avait pas encore le système en place)
			*/
			return 0;
		}
	}
	
	function traitement($custom, $mode_paypal, $type_paiementt)
	{
		require_once(dirname(__FILE__) . "/../../libs/Mail.php");
		
		$mailer = new Mail();
		
		$custom_r = explode('|', $custom);
				
		$id_paypal = $custom_r[0];
		$id_client = $custom_r[1];
		$estClient = $custom_r[2];
		$langue = $custom_r[3];   /*Informations MARC, ICI $langue est la variable $_SESSION['lang']  **/
		$ecrire_dans_db = $custom_r[4]; // si on doit ecrire les données dans la base
		$maj_paye = $custom_r[5]; // si c'est un paiement après la réservation, on met à jour la variable "est_paye"
		$id_ligne = $custom_r[6]; // ligne 1
		$is_ar = $custom_r[7]; // si on paye l'aller et le retour
		$id_ligne_2 = $custom_r[8]; // ligne 2
        $pro = $custom_r[9]; // si pro ou pas

        if($pro == "1")
        {
            write("UPDATE aeroport_facture_pro SET statut = 1 WHERE id_pro = " . $id_client . " AND DATE <= " . $id_paypal);

            $ret = query("SELECT mail, nom, prenom FROM aeroport_client WHERE id_client = " . $id_client);
            $r_mail = $ret->fetch();
            $mail_client = $r_mail['mail'];

            $date_f = str_split($id_paypal, 1);

            $date_ff = $date_f[6] . $date_f[7] . "/" . $date_f[4] . $date_f[5] . "/" . $date_f[0] . $date_f[1] . $date_f[2] . $date_f[3];
            
          /***************************************
           * Personnalisation du message en fonction de la langue choisit du formulaire de reservation 
           * Modification : MARC
           * **************************************/  
            switch($langue){            
            
            case 'fr':
 			$content_mail = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement pour tout les trajets précédent le ".$date_ff.".<br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    		break;
			
			case 'en':
			$content_mail = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement pour tout les trajets précédent le ".$date_ff.".<br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
    		break;
			
			default:
            $content_mail = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement pour tout les trajets précédent le ".$date_ff.".<br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
            break;
            
            }
			/********************************************
			 * Fin modif
			 * ********************************/


            
			if($mode_paypal == "online")
			{
				
          /***************************************
           * Personnalisation du message en fonction de la langue choisit du formulaire de reservation 
           * Modification : MARC
           * **************************************/ 
            switch($langue){   
            	
            	case 'fr': 
				$mailer->Subject = "Paiement des réservations (professionnel)";
				break;
				
				case 'en':
				$mailer->Subject = "Paiement des réservations (professionnel)";
    			break;
			
				default:
            	$mailer->Subject = "Paiement des réservations (professionnel)";
            	break;
            
            }				
			/********************************************
			 * Fin modif
			 * ********************************/				
				
				$mailer->Body = $content_mail;
				//$mailer->AddAddress("info@alsace-navette.com");
				$mailer->AddAddress($mail_client);

				if(!$mailer->Send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
			else
			{
				file_put_contents("paiment_navette_pro.html", $content_mail);
			}
        }
		elseif($maj_paye == "1") // Note : Ici, c'est un paiement qui a été effectué en différé.
		{
			/*
				KEMPF : A faire :	
					Gestion de la mise à jour des informations de la table aeroport_paypal
					qui auraient pu être modifiée entre le moment de sa création et son paiement
					
					updateAeroportPaypal($id_paypal);		
			
			*/
		
			$sql_ligne = "UPDATE aeroport_ligne_resa SET est_paye = '1' WHERE id_ligne = '" . $id_ligne . "'";
			
			write($sql_ligne);
			
			$get_trajet = query("SELECT id_trajet FROM aeroport_ligne_resa WHERE id_ligne = '" . $id_ligne . "'");

			$r_id_trajet = $get_trajet->fetch();
			$id_trajet = $r_id_trajet['id_trajet'];
			$get_trajet->closeCursor();
			
			
			$ok = true;
			$ret_trajet = query("SELECT * FROM aeroport_ligne_resa WHERE est_paye = 0 AND id_trajet = '" . $id_trajet . "'");

			if($ret_trajet->rowCount() != 0)
				$ok = false;
			
			$ret_trajet ->closeCursor();
			
			if($ok)
			{
				$sql_trajet = "UPDATE aeroport_trajet SET est_paye = '1' WHERE id_trajet = '" . $id_trajet . "'";
					
				write($sql_trajet);
				
				// AJOUT KEMPF : Gestion de la navette vide (Navettes de retour où le conducteur est seul dans la voiture)
				ajoutNavetteVide($id_trajet);
			}
			
			if($is_ar == "1")
			{
				$sql_ligne = "UPDATE aeroport_ligne_resa SET est_paye = '1' WHERE id_ligne = '" . $id_ligne_2 . "'";
			
				write($sql_ligne);
				
				$get_trajet = query("SELECT id_trajet FROM aeroport_ligne_resa WHERE id_ligne = '" . $id_ligne_2 . "'");
	
				$r_id_trajet = $get_trajet->fetch();
				$id_trajet = $r_id_trajet['id_trajet'];
				$get_trajet->closeCursor();
				
			
				$ok = true;
				$ret_trajet = query("SELECT * FROM aeroport_ligne_resa WHERE est_paye = 0 AND id_trajet = '" . $id_trajet . "'");
	
				if($ret_trajet->rowCount() != 0)
					$ok = false;
				
				$ret_trajet ->closeCursor();
				
				if($ok)
				{
					$sql_trajet = "UPDATE aeroport_trajet SET est_paye = '1' WHERE id_trajet = '" . $id_trajet . "'";
					write($sql_trajet);
				
					// AJOUT KEMPF : Gestion de la navette vide (Navettes de retour où le conducteur est seul dans la voiture)
					ajoutNavetteVide($id_trajet);
				}
			}
			
			
			$ret_mail = query("	SELECT c.mail
								FROM 	aeroport_client c,
										aeroport_ligne_resa l,
										aeroport_reservation r
								WHERE r.id_res = l.id_res
								AND r.id_client = c.id_client
								AND l.id_ligne = '" . $id_ligne . "'");
			
			$r_mail = $ret_mail->fetch();
			
			$mail_client = $r_mail['mail'];
			
			$ret_mail->closeCursor();
			
			/* Ajout KEMPF : Facture */
			$id_facture = ajouterFacture(intval($id_paypal), $langue, $id_client);
			
		   /***************************************
           * Personnalisation du message en fonction de la langue choisit du formulaire de reservation 
           * Modification : MARC
           * **************************************/ 
            switch($langue){   
            	
				case 'fr': 
				$content_mail = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement. Votre navette est donc confirmée.<br /><br />Téléchargez votre facture ici : <a href='http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($id_facture)."'>votre facture en PDF </a>.<br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
				break;
				
				case 'en': 
				$content_mail = "<html><head></head><body>Hi,<br /><br />We have received your payment. Your shuttle is confirmed.<br /><br />Download your bill here : <a href='http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($id_facture)."'>your bill en PDF </a>.<br /><br />Alsace-navette wish you a pleasant journey !</body></html>";
				break; 
						  
				default:
				$content_mail = "<html><head></head><body>Bonjour,<br /><br />Nous avons bien recu votre paiement. Votre navette est donc confirmée.<br /><br />Téléchargez votre facture ici : <a href='http://alsace-navette.com/aeroport/gen_facture_aeroport.php?f=".sha1($id_facture)."'>votre facture en PDF <img src='http://alsace-navette.com/aeroport/images/icone_pdf.gif' /></a>.<br /><br />Alsace-navette vous souhaite un agréable voyage !</body></html>";
				break;
            }
			/********************************************
			 * Fin modif
			 * ********************************/
			
			if($mode_paypal == "online")
			{
			
				 /***************************************
				* Personnalisation du message en fonction de la langue choisit du formulaire de reservation 
				* Modification : MARC
				* **************************************/ 
				
				switch($langue){   
					
					case 'fr': 				
						$mailer->Subject = "Paiement d'une navette";
						break;
					
					case 'en': 				
						$mailer->Subject = "Payment of a shuttle";
						break;
					
					default:				
						$mailer->Subject = "Paiement d'une navette";
						break;
				}
				
				$mailer->Body = $content_mail;
				//$mailer->AddAddress("info@alsace-navette.com");
				$mailer->AddAddress($mail_client);
				
				if(!$mailer->Send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
			}
			else
			{
				file_put_contents("paiment_navette.html", $content_mail);
			}
		}		
		elseif($ecrire_dans_db == "1")
		{
			
		/***************************
		 * Debut de la prise en compte de la langue par les fichiers se situant dans 	aeroport/includes/
		 * 
		 * en.lang.php
		 * fr.lang.php
		 * 
		 * ************/			
			require(dirname(__FILE__) . "/../includes/" . $langue . ".lang.php");
			
			
			$ret = query("	SELECT 	*,
									DATE_FORMAT(date_depart, '%d/%m/%Y') AS date_depart_mail, 
									DATE_FORMAT(date_retour, '%d/%m/%Y') AS date_retour_mail, 
									DATE_FORMAT(heure_reel_aller, '%Hh%i') AS heure_reel_aller_mail, 
									DATE_FORMAT(heure_reel_retour, '%Hh%i') AS heure_reel_retour_mail,
									DATE_FORMAT(date_depart, '%H:%i') AS heure_aller, 
									DATE_FORMAT(date_retour, '%H:%i') AS heure_retour,
									DATE_FORMAT(date_depart, '%Y-%m-%d %H:%i:%s') AS date_full_aller, 
									DATE_FORMAT(date_retour, '%Y-%m-%d %H:%i:%s') AS date_full_retour

							FROM aeroport_paypal
							WHERE id_paypal = '" . $id_paypal . "'");
					
			$row = $ret->fetch();
			
			$client = "";
			$reservation = "";
			$id_trajet1 = 0;
			$id_trajet2 = 0;
			$id_ligne1 = 0;
			$id_ligne2 = 0;
			
			$nb_alea = mt_rand() . time();
			
			
			$est_client_pro = false;
			
			
			if($estClient == 0) // si nouveau client
			{
                $a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüûýýþÿRr";
                $b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr";

                $string = strtr(utf8_decode($row['prenom']), utf8_decode($a), $b);
                $string = strtolower($string);

                $string = str_replace(" ", "", $string);

/*
 * ICI ON ATTRIBUE LE MOT DE PASSE AU CLIENT
 *  a faire à determiner quel est le tél portable utilise qui est enregistre dans la table aeroport_paypal.
 * Info MARC
 * */
				$nomMaj = strtoupper($row['nom']); //Nom en majuscule
				$prenomM = $row['prenom'];
				$total=strlen($prenomM); // taille de la chaine
				$prenomM[0] = strtoupper($prenomM[0]); //on met en majuscule le premier caractère
				for ($i=1 ; $i < $total-1; $i++) { //pour tous les caractères de la chaine (sauf la dernière $total-1, et la première qui est déjà fait)
					if (($prenomM[$i] == " ") || ($prenomM[$i] == "-")) { //si le caractère est " " ou "-"
						$prenomM[$i+1] = strtoupper($prenomM[$i+1]); //on met en caps le caractère qui suit
						$i++; //on saute le caractère qu'on vient de mettre en caps
					}
				}
				$password = addslashes(htmlspecialchars_decode($string)) . mt_rand(0, 9) . mt_rand(0, 9);
				
				$txt = addslashes(htmlspecialchars_decode($nomMaj))." ".addslashes(htmlspecialchars_decode($prenomM))." ".addslashes(htmlspecialchars_decode($row['adresse']))." ".addslashes(htmlspecialchars_decode($row['code_post']))." ".addslashes(htmlspecialchars_decode($row['ville']))." ".addslashes(htmlspecialchars_decode($row['email']));
				
				$client = "INSERT INTO aeroport_client
							VALUES (
									null,
									'" . intval($row['pays']) . "', 
									'" . addslashes(htmlspecialchars_decode($row['civilite'])) . "',
									'" . addslashes(htmlspecialchars_decode($nomMaj)) . "',
									'" . addslashes(htmlspecialchars_decode($prenomM)) . "',
									'" . addslashes(htmlspecialchars_decode($row['adresse'])) . "',
									'" . addslashes(htmlspecialchars_decode($row['code_post'])) . "',
									'" . addslashes(htmlspecialchars_decode($row['ville'])) . "',
									'" . addslashes(htmlspecialchars_decode($row['email'])) . "',
									'" . addslashes(htmlspecialchars_decode($row['fixe'])) . "',
									'" . addslashes(htmlspecialchars_decode($row['portable'])) . "',
									'" . $password . "',
									NOW(),
									'" . $row['ip'] . "',
									'0',
									'" . $nb_alea . "',
                                    '" . $row['ind_fixe'] . "',
                                    '" . $row['ind_port'] . "',
                                    '0',
                                    '".$txt."',
                                    null
									)";
				
				$r_tmp = write2($client);
				
				$id_client = $r_tmp->lastInsertId();
				
			}
			else
			{
				$ret_alea = query("SELECT nb_alea, professionnel FROM aeroport_client WHERE id_client = '" . $id_client . "'");
				$row_alea = $ret_alea->fetch();
				$nb_alea = $row_alea["nb_alea"];
				$est_client_pro = ($row_alea['professionnel'] == '0') ? false : true;
				$ret_alea->closeCursor();
			}
	
			
			
			// insertion de la réservation


			$a_payer_aller = 1;
            $a_payer_retour = 1;


            if($row['a_payer_aller'] == 0)
                $a_payer_aller = 0;

            if($row['a_payer_retour'] == 0)
                $a_payer_retour = 0;

            if($est_client_pro)
            {
                $a_payer_aller = 1;
                $a_payer_retour = 1;
            }

				
			$supplement = 0;
			
			if($row['is_der_min'] == "24")
				$supplement = intval(get_option("maj_24"));
			elseif($row['is_der_min'] == "72")
				$supplement = intval(get_option("maj_72"));
			else
				$supplement = 0;
				
				
			$reservation = "INSERT INTO aeroport_reservation
							VALUES (
									null,
									'" . intval($id_client) . "',
									NOW(),
									'" . addslashes($row['info_compl']) . "',
									'" . intval($row['type_trajet']) . "',
									'" . intval($supplement) . "',
									'" . $row['is_der_min'] . "'";
			
			$reservation .= ",'".$_SESSION['txtPortable']."'";
			$reservation .=",'null'";
			if($_SESSION['txtNom']!="" || $_SESSION['txtNom']!=null)
			{
				$reservation .= ",'". addslashes ($_SESSION['txtNom'])."'";
			}
			else
			{
				$reservation .= ",'". addslashes ($_SESSION['client']['nom'])."'";
			}
			
			/******************************	
			 * 
			 * Mon rajout pour l'ajout de la langue de la session sous forme de caractere  utilisé durant
			 * la reservation rajout dans le champ session_lang de la table aeroport_reservation
			 * 
			 * Le renseignement est obligatoire car l'ajout car l'envoie du SMS se fait à partir d une base de données. 
			 * ***************************/
			$reservation .= ",'".$langue."'";
			
			// KEMPF : Ajout de l'option d'annulation
			$option_annulation = $row['opt_annulation'];
			$montant_option_annulation = $row['montant_opt_annulation'];
			$reservation .= ",'".$option_annulation."'";
			$reservation .= ",'".$montant_option_annulation."'";
			
			// KEMPF : Ajout du type du client
			$reservation .= ",'".$row['type_client']."'";
				
			$reservation.= ")";
			
			$r_tmp = write2($reservation);
			
			$id_res = $r_tmp->lastInsertId();
			
			// On met à jour dans la table aeroport_paypal
			updatePaypalIdRes(intval($id_paypal), $id_res);
			
			
			$tab_a_rembourser = array(); // id réservation concernées
			 
			
			
			// insertion du trajet
			
			// aller
			if($row['existant_aller'] != 0) // si on se rajoute sur une navette
			{
				// réservation et client à rembourser

                $ret_remb_aller = query("select l.id_ligne
                                        from aeroport_ligne_resa l, aeroport_trajet t, aeroport_reservation r
                                        where l.id_trajet = t.id_trajet
                                        and r.id_res = l.id_res
                                        and r.id_client = t.id_initiateur
                                        and l.id_trajet = '" . $row['existant_aller'] . "'");

				$row_res_remb_aller = $ret_remb_aller->fetch();
                $id_ligne_remb_aller = $row_res_remb_aller['id_ligne'];
				$ret_remb_aller->closeCursor();
				
				// nombre de personne déjà sur la navette
				$ret_nb_pers = query("SELECT SUM(nb_pers+nb_enfant) as nb_pers
										FROM aeroport_ligne_resa
										WHERE id_trajet = '" . $row['existant_aller'] . "'");
				
				$row_nb_pers_aller = $ret_nb_pers->fetch();
				
				$nb_pers_aller = $row_nb_pers_aller['nb_pers']; // nombre de personne qui prenne cette navette
			
				$ret_nb_pers->closeCursor();
				
				
				// est-ce qu'on ce rajoute sur une navette fixe ou pas
				
				$ret_fixe_ou_pas = query("SELECT estFixe
										 FROM aeroport_trajet
										 WHERE id_trajet = '" . $row['existant_aller'] . "'");
				
				$row_fixe_ou_pas = $ret_fixe_ou_pas->fetch();
				
				$fixe_ou_pas = intval($row_fixe_ou_pas['estFixe']);
				
				$ret_fixe_ou_pas->closeCursor();
				
				
				// info sur le forfait minimum
				$ret_nb_pers_forfait = query("SELECT nb_personne, prix_forfait/nb_personne AS prix
											 FROM aeroport_lieu
											 WHERE id_lieu = '" . (($row['id_dest'] == 100) ? $row['id_depart'] : $row['id_dest']) . "'");
			
				$row_nb_pers_forfait = $ret_nb_pers_forfait->fetch();
				$nb_pers_forfait = $row_nb_pers_forfait['nb_personne'];
				$prix_par_personne = round($row_nb_pers_forfait['prix'], 2);
				$ret_nb_pers_forfait->closeCursor();
				
				// si le nombre de personnes qui sont déjà sur la navette est < au nb de pers du forfait mini
				if($nb_pers_aller < $nb_pers_forfait)
				{
					$nb = $row['passager_adulte_aller'] + $row['passager_enfant_aller'];
					$fin = false;
					$i = 1;
					while(!$fin && $i <= $nb)
					{
						if(($nb_pers_aller + $i) > $nb_pers_forfait)
							$fin = true;
						else
							$i++;
					}
						
					
					$tab_a_rembourser[] = $id_ligne_remb_aller;
	
					$montant_a_rembourser = $prix_par_personne * ($i - 1);
						
					$a_rembourser_aller = "UPDATE aeroport_ligne_resa
										  SET remboursement = remboursement+'" . $montant_a_rembourser . "'
										  WHERE id_ligne = '" . $id_ligne_remb_aller . "'";
	
	
					write($a_rembourser_aller);
				}
				
				
				// insertion de la ligne résa
				$r_tmp = ligne_resa('aller', $id_res, $row['existant_aller'], $row, $langue, "1", $a_payer_aller, $type_paiementt);
				
				$id_trajet1 = $row['existant_aller'];
				
				$id_ligne1 = $r_tmp->lastInsertId();
			}
			else
			{	
				if($row['id_depart'] == 100) // si départ strasbourg
				{
					// insertion du trajet	
					$r_tmp = trajet($row, $row['chauffeur_aller'], $row['vehicule_aller'], 'depart', $row['id_depart'], $row['id_dest'], $a_payer_aller, intval($id_client));
					
					$id_trajet1 = $r_tmp->lastInsertId();
					
					// AJOUT KEMPF : Gestion de la navette vide (Navettes de retour où le conducteur est seul dans la voiture)
					ajoutNavetteVide($id_trajet1);
					
					$row['id_com_aller'] = ($row['id_com_aller'] == 0) ? (get_max_id("aeroport_gestion_planning", "id_com") + 1) : $row['id_com_aller'];
					
					gestion_planning($row['id_com_aller'], $row['chauffeur_aller'], $row['vehicule_aller'], 'aller', $id_trajet1, $row['id_dest']);
				
					// insertion de la ligne résa
					$r_tmp = ligne_resa('aller', $id_res, $id_trajet1, $row, $langue, "0", $a_payer_aller, $type_paiementt);
					
					$id_ligne1 = $r_tmp->lastInsertId();
				}
				else
				{			
					$r_tmp = trajet($row, $row['chauffeur_aller'], $row['vehicule_aller'], 'depart', $row['id_depart'], $row['id_dest'], $a_payer_aller, intval($id_client));
					
					$id_trajet1 = $r_tmp->lastInsertId();
					
					// AJOUT KEMPF : Gestion de la navette vide (Navettes de retour où le conducteur est seul dans la voiture)
					ajoutNavetteVide($id_trajet1);
		
					$row['id_com_aller'] = ($row['id_com_aller'] == 0) ? (get_max_id("aeroport_gestion_planning", "id_com") + 1) : $row['id_com_aller'];
					
					gestion_planning($row['id_com_aller'], $row['chauffeur_aller'], $row['vehicule_aller'], 'retour', $id_trajet1,  $row['id_depart']);
				
					// insertion de la ligne résa
					$r_tmp = ligne_resa('aller', $id_res, $id_trajet1, $row, $langue, "0", $a_payer_aller, $type_paiementt);
					
					$id_ligne1 = $r_tmp->lastInsertId();
				}
			
			}
			
			
			// retour
			if($row['type_trajet'] == 0)
			{
				// retour
				if($row['existant_retour'] != 0) // si on se rajoute sur une navette	
				{
 
                     $ret_remb_retour = query("select l.id_ligne
                                        from aeroport_ligne_resa l, aeroport_trajet t, aeroport_reservation r
                                        where l.id_trajet = t.id_trajet
                                        and r.id_res = l.id_res
                                        and r.id_client = t.id_initiateur
                                        and l.id_trajet = '" . $row['existant_retour'] . "'");
			
					$row_res_remb_retour = $ret_remb_retour->fetch();
					$id_ligne_remb_retour = $row_res_remb_retour['id_ligne'];
					$ret_remb_retour->closeCursor();
					
					$ret_nb_pers = query("SELECT SUM(nb_pers+nb_enfant) as nb_pers
											FROM aeroport_ligne_resa
											WHERE id_trajet = '" . $row['existant_retour'] . "'");
					
					$row_nb_pers_retour = $ret_nb_pers->fetch();
					
					$nb_pers_retour = $row_nb_pers_retour['nb_pers']; // nombre de personne qui prenne cette navette
			
					$ret_nb_pers->closeCursor();
					
					
					// est-ce qu'on ce rajoute sur une navette fixe ou pas
				
					$ret_fixe_ou_pas = query("SELECT estFixe
											 FROM aeroport_trajet
											 WHERE id_trajet = '" . $row['existant_retour'] . "'");
					
					$row_fixe_ou_pas = $ret_fixe_ou_pas->fetch();
					
					$fixe_ou_pas = intval($row_fixe_ou_pas['estFixe']);
					
					$ret_fixe_ou_pas->closeCursor();
				
				
					
					$ret_nb_pers_forfait = query("SELECT nb_personne, prix_forfait/nb_personne AS prix
												 FROM aeroport_lieu
												 WHERE id_lieu = '" . (($row['id_dest'] == 100) ? $row['id_depart'] : $row['id_dest']) . "'");
			
					$row_nb_pers_forfait = $ret_nb_pers_forfait->fetch();
					$nb_pers_forfait = $row_nb_pers_forfait['nb_personne'];
					$prix_par_personne = round($row_nb_pers_forfait['prix'], 2);
					$ret_nb_pers_forfait->closeCursor();
					
					// si le nombre de personnes qui sont déjà sur la navette est < au nb de pers du forfait mini
					if($nb_pers_retour < $nb_pers_forfait)
					{
						
						$nb = $row['passager_adulte_aller'] + $row['passager_enfant_aller'];
						$fin = false;
						$i = 1;
						while(!$fin && $i <= $nb)
						{
							if(($nb_pers_retour + $i) > $nb_pers_forfait)
								$fin = true;
							else
								$i++;
						}
						
						
						$tab_a_rembourser[] = $id_ligne_remb_retour;
						
						$montant_a_rembourser = $prix_par_personne * ($i - 1);
			
						$a_rembourser_retour = "UPDATE aeroport_ligne_resa
											  SET remboursement = remboursement+'" . $montant_a_rembourser . "'
											  WHERE id_ligne = '" . $id_ligne_remb_retour . "'";
			
			
						write($a_rembourser_retour);
	
					}	
					
					$r_tmp = ligne_resa('retour', $id_res, $row['existant_retour'], $row, $langue, "1", $a_payer_retour, $type_paiementt);
					
					$id_trajet2 = $row['existant_retour'];
					
					$id_ligne2 = $r_tmp->lastInsertId();
	
				}
				else
				{
					/****
					 * 
					 * 
					 * Info MARC: row['id_dest'] provient de la table aeroport_lieu du champ id_lieu !
					 * */
					if($row['id_dest'] == 100) // si arrivé strasbourg
					{						
						$r_tmp = trajet($row, $row['chauffeur_retour'], $row['vehicule_retour'], 'retour', $row['id_dest'], $row['id_depart'], $a_payer_retour, intval($id_client));
										
						$id_trajet2 = $r_tmp->lastInsertId();
		
						$row['id_com_retour'] = ($row['id_com_retour'] == 0) ? (get_max_id("aeroport_gestion_planning", "id_com") + 1) : $row['id_com_retour'];
					
						gestion_planning($row['id_com_retour'], $row['chauffeur_retour'], $row['vehicule_retour'], 'aller', $id_trajet2,  $row['id_dest']);
					
						// insertion de la ligne résa													
						$r_tmp = ligne_resa('retour', $id_res, $id_trajet2, $row, $langue, "0", $a_payer_retour, $type_paiementt);
						
						$id_ligne2 = $r_tmp->lastInsertId();
					}
					else
					{						
						$r_tmp = trajet($row, $row['chauffeur_retour'], $row['vehicule_retour'], 'retour', $row['id_dest'], $row['id_depart'], $a_payer_retour, intval($id_client));
										
						$id_trajet2 = $r_tmp->lastInsertId();
		
						$row['id_com_retour'] = ($row['id_com_retour'] == 0) ? (get_max_id("aeroport_gestion_planning", "id_com") + 1) : $row['id_com_retour'];
						
						gestion_planning($row['id_com_retour'], $row['chauffeur_retour'], $row['vehicule_retour'], 'retour', $id_trajet2,  $row['id_dest']);
					
						// insertion de la ligne résa				
						$r_tmp = ligne_resa('retour', $id_res, $id_trajet2, $row, $langue, "0", $a_payer_retour, $type_paiementt);
						
						$id_ligne2 = $r_tmp->lastInsertId();
					}
				}
			}
			
			
			// insertion dans aeroport_facture_pro pour la gestion du paiement à la fin du mois des professionnels
			
			if($est_client_pro)
			{
				if($id_ligne1 != 0)
                {
                    $date_pro = explode(' ', $row['date_depart']);
                    $annee_pro = explode('-', $date_pro[0]);

					$sql = "INSERT INTO aeroport_facture_pro(id_pro, num_ligne, date, statut) VALUES (" . $id_client . ", " . $id_ligne1 . ", '" . $annee_pro[0] . $annee_pro[1] . $annee_pro[2] . "', 0)";
                    write($sql);
                }
				
				if($id_ligne2 != 0)
                {
                    $date_pro = explode(' ', $row['date_retour']);
                    $annee_pro = explode('-', $date_pro[0]);

					$sql = "INSERT INTO aeroport_facture_pro(id_pro, num_ligne, date, statut) VALUES (" . $id_client . ", " . $id_ligne2 . ", '" . $annee_pro[0] . $annee_pro[1] . $annee_pro[2] . "', 0)";
                    write($sql);
                }
			}
			

			$somme_prix_finale = 0;
			
			$tabulation = "&nbsp;&nbsp;&nbsp;&nbsp;";
			$mail_client = "";
			$mail_rajout_afi = "";


            // mail client
			$nomMaj = strtoupper($row['nom']); //Nom en majuscule
			$prenomM = $row['prenom'];
			$total=strlen($prenomM); // taille de la chaine
			$prenomM[0] = strtoupper($prenomM[0]); //on met en majuscule le premier caractère
			for ($i=1 ; $i < $total-1; $i++) { //pour tous les caractères de la chaine (sauf la dernière $total-1, et la première qui est déjà fait)
				if (($prenomM[$i] == " ") || ($prenomM[$i] == "-")) { //si le caractère est " " ou "-"
					$prenomM[$i+1] = strtoupper($prenomM[$i+1]); //on met en caps le caractère qui suit
					$i++; //on saute le caractère qu'on vient de mettre en caps
				}
			}

            $mail_client = $bonjour . " <strong>" . $row['civilite'] . " " . $prenomM . " " . $nomMaj . "</strong>,<br /><br />";
            $mail_client .= $demande_traite . "<br /><br />";
            $mail_client .= $trajet_type . " : <strong>" . ((intval($row['type_trajet']) == 1) ? $trajet_aller_simple : $trajet_aller_retour) . "</strong><br />";
            $mail_client .= "<br /><strong>" . $aller . " :</strong><br /><br />";
            
            // KEMPF : Ajout d'un lien vers le site pour voir les info's de l'aéroport (Uniquement si <> Strasbourg)
			$lesInfosDuLieu = get_infos_lieu(intval($row['id_depart']));
			if (intval($row['id_depart']) != 100 && !empty($lesInfosDuLieu['lien_plan_sortie'])){
				$mail_client .= $tabulation . $trajet_depart . " : <strong>" . get_lieu(intval($row['id_depart'])) . "</strong> <a href ='".$lesInfosDuLieu['lien_plan_sortie']."'>" . $lesInfosDuLieu['libelle_sortie_'.$langue] . "</a><br />";
			}else{
				$mail_client .= $tabulation . $trajet_depart . " : <strong>" . get_lieu(intval($row['id_depart'])) . "</strong><br />";
			}
			
			// KEMPF : Ajout d'un lien vers le site pour voir les info's de l'aéroport (Uniquement si <> Strasbourg)
			$lesInfosDuLieu = get_infos_lieu(intval($row['id_dest']));
			if (intval($row['id_dest']) != 100 && !empty($lesInfosDuLieu['lien_plan_sortie'])){
				$mail_client .= $tabulation . $trajet_arrive . " : <strong>" . get_lieu(intval($row['id_dest'])) . "</strong> <a href ='".$lesInfosDuLieu['lien_plan_sortie']."'>" . $lesInfosDuLieu['libelle_sortie_'.$langue] . "</a><br />";
			}else{
				$mail_client .= $tabulation . $trajet_arrive . " : <strong>" . get_lieu(intval($row['id_dest'])) . "</strong><br />";
			}
			
            $mail_client .= $tabulation . $date . " : <strong>" . $row['date_depart_mail'] . "</strong><br />";
            $mail_client .= $tabulation . $heure . " : <strong>" . $row['heure_reel_aller_mail'] . "</strong><br />";
            $mail_client .= $tabulation . $pt_rassemblement . " : <strong>" . get_pt_rass2($row['id_pt_rass_aller'], $langue) . "</strong> ";

            if(intval($row['id_pt_rass_aller']) == 4)
            {
                $mail_client .= "<br />" . $tabulation . $tabulation . $adresse_client . " : <strong>" . $row['rass_adresse_aller'] . "</strong><br />";
                $mail_client .= $tabulation . $tabulation . $code_post_client . " : <strong>" . $row['rass_cp_aller'] . "</strong><br />";
                $mail_client .= $tabulation . $tabulation . $ville_client . " : <strong>" . $row['rass_ville_aller'] . "</strong>";
                $mail_client .= $tabulation . $tabulation . $pays_client . " : <strong>" . get_pays2($row['rass_pays_aller']) . "</strong>";
            }
            else
            {
                $mail_client .= " (";

                if($row['id_pt_rass_aller'] == 1)
                    $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">";
                elseif($row['id_pt_rass_aller'] == 2)
                    $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=6+rue+Fritz+Kieffer+strasbourg&mrt=all&sll=48.596294,7.753644&sspn=0.006869,0.019312&ie=UTF8&ll=48.596294,7.753644&spn=0.006869,0.019312&z=16\">";
                else
                    $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+3+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">";


                $mail_client .= $plan . "</a>)";
            }

            $mail_client .= "<br />" . $tabulation . $nombre_passager . " : <strong>" . (intval($row['passager_adulte_aller']) + intval($row['passager_enfant_aller'])) . "</strong><br />";
			
			/**
			 * rajout du nom autre du passager dans l'email
			**/
			 
			if($_SESSION['chckPassagerDifferent']=='oui'){
				$mail_client .= "<br />" . $tabulation . $nom_autre_passager ." ". $titre_autre_passager . " : <strong>" .  $_SESSION['txtNom']  . "</strong><br />";
				$mail_client .= "" . $tabulation . $indicatif_tel_autre_passager  . " : <strong>" .   $_SESSION['txtIndicatifPortable']  . "</strong><br />";
				$mail_client .= "" . $tabulation . $tel_port_autre_passager . " : <strong>" .  $_SESSION['txtPortable']  . "</strong><br />";
			}
			
            // Ajout du commantaire par Alexandre
            $recupCommentaire = 'select commentaire from aeroport_reservation where id_res='.$id_res;   
            $statement=Connectbdd()->prepare($recupCommentaire);
            $statement->execute();
            $res=$statement->fetchall();
            
            foreach($res as $res){
				if($res['commentaire']!="" || $res['commentaire']!=null)
					$mail_client .= $tabulation."Commentaire : ".$res['commentaire']."<br />";
				
            }// FIn ajout commentaire
            
			$prix_aller = get_prix($id_ligne1, "prix");
			
            $mail_client .= "<br /><br />" . $sous_total . " : " . $prix_aller . " €";
			
			$somme_prix_finale += $prix_aller;
			
            if(get_prix($id_ligne1, "est_paye") == '0')
                $mail_client .= " (" . $non_paye . ")";
            else
                $mail_client .= " (" . $est_paye . ")";
                

            if($row['type_resa_aller'] == "ATTENDRE")
                $mail_client .= "<br />" . $mail_attendre;
            else
            {
                for($i = 0; $i < count($tab_a_rembourser); $i++)
				{
                    $sql = "SELECT c.nom, c.prenom, c.mail, l.remboursement
                            FROM aeroport_client c, aeroport_ligne_resa l, aeroport_reservation r
                            WHERE l.id_ligne = '" . $tab_a_rembourser[$i] . "'
                            AND r.id_res = l.id_res
                            AND r.id_client = c.id_client";


					$remboursement = query($sql);
					$row_remb = $remboursement->fetch();
			/**
			 * 
			 *	Prise en compte uniquement du français à voir si il faut le changer
			 *	Info : Marc
 			* **/
					$mail_rajout_afi .= "<font color=\"red\"><br /><br />Il s'agit d'un rajout sur une navette qui avait payée le forfait minimum. Il faut donc rembourser <strong>" . $row_remb['nom'] . " " . $row_remb['prenom'] . " (" . $row_remb['mail'] . ")</strong> la somme de <strong>" . $row_remb['remboursement'] . " €</strong>. Attention toutefois aux possibles rajout futur sur la même navette (il ne faudrait pas rembourser plusieurs fois le même client !)";

					if($row['res_der_min'] != "0")
						$mail_rajout_afi .= "<br />De plus, ce rajout est un rajout de dernière minute !";

					$mail_rajout_afi .= "</font>";

					$remboursement->closeCursor();
				}
            }

            // le retour
            if(intval($row['type_trajet']) == 0)
            {
                $mail_client .= "<br /><br /><strong> " . $retour . "</strong><br /><br />";
				
				// KEMPF : Ajout d'un lien vers le site pour voir les info's de l'aéroport (Uniquement si <> Strasbourg)
				$lesInfosDuLieu = get_infos_lieu(intval($row['id_dest']));
				if (intval($row['id_dest']) != 100 && !empty($lesInfosDuLieu['lien_plan_sortie'])){
					$mail_client .= $tabulation . $trajet_depart . " : <strong>" . get_lieu(intval($row['id_dest'])) . "</strong> <a href ='".$lesInfosDuLieu['lien_plan_sortie']."'>" . $lesInfosDuLieu['libelle_sortie_'.$langue] . "</a><br />";
				}else{
					$mail_client .= $tabulation . $trajet_depart . " : <strong>" . get_lieu(intval($row['id_dest'])) . "</strong><br />";
				}
				
				// KEMPF : Ajout d'un lien vers le site pour voir les info's de l'aéroport (Uniquement si <> Strasbourg)
				$lesInfosDuLieu = get_infos_lieu(intval($row['id_depart']));
				if (intval($row['id_depart']) != 100 && !empty($lesInfosDuLieu['lien_plan_sortie'])){
					$mail_client .= $tabulation . $trajet_arrive . " : <strong>" . get_lieu(intval($row['id_depart'])) . "</strong> <a href ='".$lesInfosDuLieu['lien_plan_sortie']."'>" . $lesInfosDuLieu['libelle_sortie_'.$langue] . "</a><br />";
				}else{
					$mail_client .= $tabulation . $trajet_arrive . " : <strong>" . get_lieu(intval($row['id_depart'])) . "</strong><br />";
				}
				
                $mail_client .= $tabulation . $date . " : <strong>" . $row['date_retour_mail'] . "</strong><br />";
                $mail_client .= $tabulation . $heure . " : <strong>" . $row['heure_reel_retour_mail'] . "</strong><br />";
                $mail_client .= $tabulation . $pt_rassemblement . " : <strong>" . get_pt_rass2($row['id_pt_rass_retour'], $langue) . "</strong> ";

                if(intval($row['id_pt_rass_retour']) == 4)
                {
                    $mail_client .= "<br />" . $tabulation . $tabulation . $adresse_client . " : <strong>" . $row['rass_adresse_retour'] . "</strong><br />";
                    $mail_client .= $tabulation . $tabulation . $code_post_client . " : <strong>" . $row['rass_cp_retour'] . "</strong><br />";
                    $mail_client .= $tabulation . $tabulation . $ville_client . " : <strong>" . $row['rass_ville_retour'] . "</strong>";
                    $mail_client .= $tabulation . $tabulation . $pays_client . " : <strong>" . get_pays2($row['rass_pays_retour']) . "</strong>";
                }
                else
                {
                    $mail_client .= " (";

                    if($row['id_pt_rass_retour'] == 1)
                        $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=Rue+Ren%C3%A9+Cassin+Strasbourg&sll=48.601928,7.745447&sspn=0.027471,0.077248&ie=UTF8&ll=48.59892,7.775552&spn=0.006528,0.019312&z=16\">";
                    elseif($row['id_pt_rass_retour'] == 2)
                        $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=6+rue+Fritz+Kieffer+strasbourg&mrt=all&sll=48.596294,7.753644&sspn=0.006869,0.019312&ie=UTF8&ll=48.596294,7.753644&spn=0.006869,0.019312&z=16\">";
                    else
                        $mail_client .= "<a href=\"http://maps.google.fr/maps?f=q&amp;hl=fr&amp;geocode=&amp;time=&amp;date=&amp;ttype=&amp;q=strasbourg+5+bld+Metz&amp;sll=48.582172,7.732444&amp;sspn=0.010164,0.020084&amp;ie=UTF8&amp;ll=48.583634,7.733924&amp;spn=0.010163,0.020084&amp;z=16&amp;iwloc=addr&amp;om=1\">";


                    $mail_client .= $plan . "</a>)";
                }


                $mail_client .= "<br />" . $tabulation . $nombre_passager . " : <strong>" . (intval($row['passager_adulte_aller']) + intval($row['passager_enfant_aller'])) . "</strong><br />";
				
				$prix_retour = get_prix($id_ligne2, "prix");
				
                $mail_client .= "<br /><br />" . $sous_total . " : " . $prix_retour . " €";
				
				$somme_prix_finale += $prix_retour;

                if(get_prix($id_ligne2, "est_paye") == '0')
                    $mail_client .= " (" . $non_paye . ")";
                else
                    $mail_client .= " (" . $est_paye . ")";


                if($row['type_resa_retour'] == "ATTENDRE")
                    $mail_client .= "<br />" . $mail_attendre;
            }
			
			// KEMPF : Ajout des CGV
			$mail_client .= "<br /><br /><a href='http://alsace-navette.com/aeroport/cgv.php'><strong>" . $cgv . "</strong></a>";
			
			// KEMPF : Ajout de l'option sérénité
			if ($row['opt_annulation'] == 1){
				switch($langue){
					case 'en': 
						$mail_client .= "<br /><br />The Serenity Option is activated (Cancelation service) : ".$row['montant_opt_annulation']." €";
						break;
					
					default:
						$mail_client .= "<br /><br />Vous disposez de l'option Sérénité (Service d'annulation) : ".$row['montant_opt_annulation']." €";
						break;
				}
			}
			
            $mail_client .= "<br /><br /><strong>" . $prix_total . " : " . $somme_prix_finale . " €</strong> (" . $type_paiementt . ")<br />";


            if($row['res_der_min'] == "0" || get_prix($id_ligne1, "est_paye") == '1')
            {
                if($row['type_resa_aller'] == "ATTENDRE" || $row['type_resa_retour'] == "ATTENDRE")
                {
                    $mail_client .= "<br />" . $fin_demande2;
                }
                else
				{
                    $mail_client .= "<br />" . $fin_demande;	
					/*
						Ajout KEMPF :
						Envoi du lien vers la facture
					*/
			
					/* Ajout KEMPF : Facture */
					$id_facture = ajouterFacture(intval($id_paypal), $langue, $id_client);
					
					switch($langue){
						case 'fr': 
							$mail_client .= "<br /><br />Téléchargez votre facture ici : <a href='http://alsace-navette.com/aeroport/facture-".sha1($id_facture)."'>votre facture en PDF</a>.";
							break;
						
						case 'en': 
							$mail_client .= "<br /><br />Download your bill here : <a href='http://alsace-navette.com/aeroport/facture-".sha1($id_facture)."'>your bill en PDF</a>.";
							break;
						
						default:
							$mail_client .= "<br /><br />Téléchargez votre facture ici : <a href='http://alsace-navette.com/aeroport/facture-".sha1($id_facture)."'>votre facture en PDF</a>.";
							break;
					}
				}
				
            }
			else
				$mail_client .= "<br />" . $fin_demande_der_min;
			
			/***
			 * 
			 * Prise en compte du français à voir si il faut changer
			 * 
			 * à voir dans le les fichiers de la langue
			 * la variable serait 
			 * $txt_moyen_port 
			 * */
			 
            $footer_mail = "<br /><br />". $lien_sondage . "<br /><br />Alsace navette<br />2, Rue du Coq<br />67000 Strasbourg<br />Tel : 03.88.22.22.71<br />En cas d'urgence : 06.27.18.12.52";


			if($row['envoyer_mail'] == "1")
			{
				if($mode_paypal == "online")
				{
                    $sujet_mail_client = $titre_recap_mail_client;

                    if($row['is_der_min'] == "24")
                        $sujet_mail_client .= ' ' . $mail_derniere_minute;


                    // si rajout de dernière minute sur navette déjà validée (à - 12h)

                    if($row['existant_aller'] != 0)
                    {
                        $estValide = query("SELECT t.estValide, c.portable, c.nom, c.prenom
                                            FROM aeroport_trajet t, chauffeur c
                                            WHERE t.id_trajet = '" . $row['existant_aller'] . "'
                                            AND t.id_chauffeur = c.idchauffeur");

                        $row_estValide = $estValide->fetch();

                        $est_estValide = $row_estValide['estValide'];
                        $num_chauffeur = $row_estValide['portable'];
                        $nom_chauffeur = $row_estValide['nom'];
                        $prenom_chauffeur = $row_estValide['prenom'];

                        $num_chauffeur =  "33" . substr($num_chauffeur, 1);

                        $estValide->closeCursor();

                        if($est_estValide == "1")
                        {
                            $tab_tmp = explode(" ", $row['date_depart']);

                            $tab_jour_depart = explode("-", $tab_tmp[0]);
                            $tab_heure_depart = explode(":", $tab_tmp[1]);

                            $date_formatee = $tab_jour_depart[2] . "/" . $tab_jour_depart[1] . "/" . $tab_jour_depart[0] . " à " . $tab_heure_depart[0] . "h" . $tab_heure_depart[1];

                            $diff = mktime(intval($tab_heure_depart[0]), intval($tab_heure_depart[1]), 0, intval($tab_jour_depart[1]), intval($tab_jour_depart[2]), intval($tab_jour_depart[0])) - time();

                            if($diff < 3600*12)
                            {
                                // maj bdd + envoie mail

                                write("UPDATE aeroport_ligne_resa SET a_ete_mail = 1 WHERE id_ligne = '" . $id_ligne1 . "'");

								/***
								 * 
								 * Prise en compte du français à voir si il faut changer
								 * 
								 * à voir dans le les fichiers de la langue
								 * Info Marc
								 * */
								 
								 /*
									KEMPF : 
									Mise à jour : Gestion de l'anglais
								 */
								switch ($langue) {
									case "en":
										$sujet_confirmation = "Your reservation on Alsace-navette.com ";
										$mail_confirmation = "Hello <b> ".$row['civilite']." ".$row['nom']." ".$row['prenom']."</b>,<br /><br />The shuttle from <b> ".$date_formatee."</b> for <b> ".get_lieu(intval($row['id_depart']))."</b> - <b> ".get_lieu(intval($row['id_dest']))."</b> you booked on Alsace-navette.com has been validated by us ! <br />
										<b> ".$nom_chauffeur . " " . $prenom_chauffeur."</b> will welcome you aboard our shuttle to the scheduled time and place when booking. You can join your driver by phone at <b> ".$num_chauffeur."</b>.<br /><br />

										You also can, at any moment, find this information on <b> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></b> by logging with your e-mail adress and the password you received when you first booking.<br /><br /><br />

										Thank you for using our services and see you soon on Alsace-Navette.com.";
										break;
									default:
										$sujet_confirmation = "Votre réservation sur Alsace-navette.com ";
										$mail_confirmation = "Bonjour <b> ".$row['civilite']." ".$row['nom']." ".$row['prenom']."</b>,<br /><br />La navette du <b> ".$date_formatee."</b> pour <b> ".get_lieu(intval($row['id_depart']))."</b> - <b> ".get_lieu(intval($row['id_dest']))."</b> que vous avez réservée sur Alsace-navette.com a été validée par nos services ! <br />
										<b> ".$nom_chauffeur . " " . $prenom_chauffeur."</b> vous accueillera à bord de nos navettes à l'heure et au lieu prévu lors de votre réservation. Vous pourrez joindre votre conducteur par téléphone au <b> ".$num_chauffeur."</b>.<br /><br />

										Vous pouvez également à tout moment retrouver ces informations sur <b> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></b> en vous connectant à l'aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />

										Merci d'utiliser nos services et à bientôt sur Alsace-Navette.com. ";
										break;
								}

                                $mailer->Subject = $sujet_confirmation;
                                $mailer->Body = "<html><head></head><body>" . $mail_confirmation . "</body></html>";
                                //$mailer->AddAddress("info@alsace-navette.com");
                                $mailer->AddAddress($row['email']);
                                if(!$mailer->Send()) {
									echo 'Message could not be sent.';
									echo 'Mailer Error: ' . $mail->ErrorInfo;
								}

                                $mailer->ClearAddresses();


                                // SMS AFI

                                $mobile_number = '3327181252';

                                $id_lieu = "";
                                $num = "";
                                $ind = "";

                                if($row['portable'] == "")
                                {
                                    $ind = get_indicatif($row['ind_fixe']);
                                    $num = $row['fixe'];
                                }
                                else
                                {
                                    $ind = get_indicatif($row['ind_port']);
                                    $num = $row['portable'];
                                }

                                if($row['id_dest'] == 100)
                                    $id_lieu = $row['id_depart'];
                                else
                                    $id_lieu = $row['id_dest'];

                                $msg = urlencode($row['civilite'] . " " . $row['nom'] . " (" . $ind . $num . ") ajouté sur " . get_short_lieu($id_lieu) . " à " . $row['date_depart']);

                                $url_sms = "http://run.orangeapi.com/sms/sendSMS.xml?id=aa99c837828&to=".$mobile_number."&content=".$msg."";

                                file_get_contents($url_sms);


                                // SMS Chauffeur

                                $mobile_number = $num_chauffeur;

                                $url_sms = "http://run.orangeapi.com/sms/sendSMS.xml?id=aa99c837828&to=".$mobile_number."&content=".$msg."";

                                file_get_contents($url_sms);

                                // SMS Client
                                
								 /***
								 * 
								 * Prise en compte du français à voir si il faut changer
								 * 
								 * à voir dans le les fichiers de la langue
								 * 
								 * il faut lheure de départ de la navette
								 * il faut le traduire en toutes les langues  
								 * */

								/*
									KEMPF : 
									Mise à jour : Gestion de l'anglais
								 */
								$mobile_number = $ind . $num;
								
								switch ($langue) {
									case "en":
										$msg = urlencode("Alsace-navette. Your request for " . get_lieu($id_lieu) . " the " . $date_formatee . " is confirmed. " . $nom_chauffeur . " " . $prenom_chauffeur . " (+" . $num_chauffeur . ") will be your driver.");

										break;
									default:
										$msg = urlencode("Alsace-navette. Votre demande pour " . get_lieu($id_lieu) . " le " . $date_formatee . " est prise en compte. " . $nom_chauffeur . " " . $prenom_chauffeur . " (+" . $num_chauffeur . ") sera votre conducteur.");

										break;
								}
                                
                                $url_sms = "http://run.orangeapi.com/sms/sendSMS.xml?id=aa99c837828&to=".$mobile_number."&content=".$msg."";

                                file_get_contents($url_sms);

                            }
                        }
                    }

					$mailer->Subject = $sujet_mail_client;
					
					if($mail_rajout_afi == '')
					{
						$mailer->Body = "<html><head></head><body>" . $mail_client . $footer_mail . "</body></html>";
						//$mailer->AddAddress("info@alsace-navette.com");
						$mailer->AddAddress($row['email']);
                        if(!$mailer->Send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' ;
						}
					}
					else
					{
						$mailer->Body = "<html><head></head><body>" . $mail_client . $mail_rajout_afi . $footer_mail . "</body></html>";
						//$mailer->AddAddress("info@alsace-navette.com");
                        if(!$mailer->Send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						}

                        $mailer->ClearAddresses();

                        $mailer->Body = "<html><head></head><body>" . $mail_client . $footer_mail . "</body></html>";
						$mailer->AddAddress($row['email']);
                        if(!$mailer->Send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						}
					}
					
					
					$mailer->ClearAddresses();
					
					
					if($estClient == 0)
					{
						$mail = "<html><head></head><body>" . $debut_nouveau_client . $row['email'] . $milieu_nouveau_client . $password . $fin_nouveau_client . $footer_mail . "</body></html>";
						
						$mailer->Subject = $sujet_nouveau_client;
						$mailer->Body = $mail;
						$mailer->AddAddress($row['email']);
						if(!$mailer->Send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ';
						}
					}
				}
				else
				{
                    // si rajout de dernière minute sur navette déjà validée (à - 12h)

                    if($row['existant_aller'] != 0)
                    {
                        $estValide = query("SELECT t.estValide, c.portable, c.nom, c.prenom
                                            FROM aeroport_trajet t, chauffeur c
                                            WHERE t.id_trajet = '" . $row['existant_aller'] . "'
                                            AND t.id_chauffeur = c.idchauffeur");

                        $row_estValide = $estValide->fetch();

                        $est_estValide = $row_estValide['estValide'];
                        $num_chauffeur = $row_estValide['portable'];
                        $nom_chauffeur = $row_estValide['nom'];
                        $prenom_chauffeur = $row_estValide['prenom'];

                        $num_chauffeur =  "33" . substr($num_chauffeur, 1);

                        $estValide->closeCursor();

                        if($est_estValide == "1")
                        {
                            $tab_tmp = explode(" ", $row['date_depart']);

                            $tab_jour_depart = explode("-", $tab_tmp[0]);
                            $tab_heure_depart = explode(":", $tab_tmp[1]);

                            $date_formatee = $tab_jour_depart[2] . "/" . $tab_jour_depart[1] . "/" . $tab_jour_depart[0] . " à " . $tab_heure_depart[0] . "h" . $tab_heure_depart[1];

                            $diff = mktime(intval($tab_heure_depart[0]), intval($tab_heure_depart[1]), 0, intval($tab_jour_depart[1]), intval($tab_jour_depart[2]), intval($tab_jour_depart[0])) - time();

                            if($diff < 3600*12)
                            {
                                // maj bdd + envoie mail
                                
                                write("UPDATE aeroport_ligne_resa SET a_ete_mail = 1 WHERE id_ligne = '" . $id_ligne1 . "'");

								 /***
								 * 
								 * Prise en compte du français à voir si il faut changer
								 * 
								 * à voir dans le les fichiers de la langue
								 * 
								 * à traduire en toutes les langues
								 * 
								 * au cas dun reservation qui 
								 * 12 heures avant le départ
								 * */
								
								/*
									KEMPF : 
									Mise à jour : Gestion de l'anglais
								 */
								switch ($langue) {
									case "en":
										$sujet_confirmation = "Your reservation on Alsace-navette.com ";
										$mail_confirmation = "Hello <b> ".$row['civilite']." ".$row['nom']." ".$row['prenom']."</b>,<br /><br />The shuttle from <b> ".$date_formatee."</b> for <b> ".get_lieu(intval($row['id_depart']))."</b> - <b> ".get_lieu(intval($row['id_dest']))."</b> you booked on Alsace-navette.com has been validated by us ! <br />
										<b> ".$nom_chauffeur . " " . $prenom_chauffeur."</b> will welcome you aboard our shuttle to the scheduled time and place when booking. You can join your driver by phone at <b> ".$num_chauffeur."</b>.<br /><br />

										You also can, at any moment, find those informations on <b> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></b> by logging with your e-mail adress and the password you received when you first booking.<br /><br /><br />

										Thank you for using our services and see you soon on Alsace-Navette.com.";
										break;
									default:
										$sujet_confirmation = "Votre réservation sur Alsace-navette.com ";
										$mail_confirmation = "Bonjour <b> ".$row['civilite']." ".$row['nom']." ".$row['prenom']."</b>,<br /><br />La navette du <b> ".$date_formatee."</b> pour <b> ".get_lieu(intval($row['id_depart']))."</b> - <b> ".get_lieu(intval($row['id_dest']))."</b> que vous avez réservée sur Alsace-navette.com a été validée par nos services ! <br />
										<b> ".$nom_chauffeur . " " . $prenom_chauffeur."</b> vous accueillera à bord de nos navettes à l'heure et au lieu prévu lors de votre réservation. Vous pourrez joindre votre conducteur par téléphone au <b> ".$num_chauffeur."</b>.<br /><br />

										Vous pouvez également à tout moment retrouver ces informations sur <b> <a href=\"http://alsace-navette.com/aeroport\"> Alsace-navette.com </a></b> en vous connectant à l'aide de votre adresse e-mail et du mot de passe que vous avez reçu par courriel lors de votre première réservation. <br /><br /><br />

										Merci d'utiliser nos services et à bientôt sur Alsace-Navette.com. ";
										break;
								}

                                file_put_contents('confirmation.html', wordwrap($mail_confirmation, 70));



                                // SMS AFI

                                $mobile_number = '33627181252';

                                $id_lieu = "";
                                $num = "";

                                if($row['portable'] == "")
                                {
                                    $ind = get_indicatif($row['ind_fixe']);
                                    $num = $row['fixe'];
                                }
                                else
                                {
                                    $ind = get_indicatif($row['ind_port']);
                                    $num = $row['portable'];
                                }

                                if($row['id_dest'] == 100)
                                    $id_lieu = $row['id_depart'];
                                else
                                    $id_lieu = $row['id_dest'];

                                $msg = $row['civilite'] . " " . $row['nom'] . " (" . $ind . $num . ") ajouté sur " . get_short_lieu($id_lieu) . " à " . $row['date_depart'];

                                file_put_contents("sms_afi.txt", $msg);
                                

                                // SMS Chauffeur

                                $mobile_number = $num_chauffeur;

                                file_put_contents("sms_chauffeur.txt", $msg);


								/***
								 * 
								 * Prise en compte du français à voir si il faut changer
								 * 
								 * à voir dans le les fichiers de la langue
								 * */
								
                                
                                // SMS Client

                                $mobile_number = $ind . $num;
 
								/*
									KEMPF : 
									Mise à jour : Gestion de l'anglais
								 */
								$mobile_number = $ind . $num;
								
								switch ($langue) {
									case "en":
										$msg = urlencode("Alsace-navette. Your request for " . get_lieu($id_lieu) . " the " . $date_formatee . " is confirmed. " . $nom_chauffeur . " " . $prenom_chauffeur . " (+" . $num_chauffeur . ") will be your driver.");

										break;
									default:
										$msg = urlencode("Alsace-navette. Votre demande pour " . get_lieu($id_lieu) . " le " . $date_formatee . " est prise en compte. " . $nom_chauffeur . " " . $prenom_chauffeur . " (+" . $num_chauffeur . ") sera votre conducteur.");

										break;
								}
								
                                file_put_contents("sms_client.txt", $msg);
                            }
                        }
                    }
                    
                    /**
                     * 
                     *  client.html est le fichier qui est lu pour l'envoie des emails aux clients apres la reservation. 
                     * */
					file_put_contents('client.html', wordwrap($mail_client . $footer_mail, 70));

					file_put_contents('afi.html', wordwrap($mail_client . $mail_rajout_afi . $footer_mail, 70));
					
					if($estClient == 0)
					{
						$mail = "<html><head></head><body>" . $debut_nouveau_client . $row['email'] . $milieu_nouveau_client . $password . $fin_nouveau_client . $footer_mail . "</body></html>";
						
						file_put_contents('nouveau_client.html', wordwrap($mail, 70));
					}
				}
			}
			
			
			
			$tab_id = array(
							'id_client' => $id_client,
							'id_res' => $id_res,
							'id_trajet1' => $id_trajet1,
							'id_trajet2' => $id_trajet2,
							'id_ligne1' => $id_ligne1,
							'id_ligne2' => $id_ligne2,
							'nb_alea' => $nb_alea
							);
			
			return $tab_id;
	
		}
		/***************************
		 * Fin de la prise en compte de la langue par les fichiers se situant dans 	aeroport/includes/
		 * 
		 * en.lang.php
		 * fr.lang.php
		 * 
		 * ************/		
		
	}
	
?>
