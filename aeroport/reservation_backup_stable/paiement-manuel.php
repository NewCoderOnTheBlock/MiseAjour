<?php

	session_start();
	
	require_once('../includes/tpl_base.php');
	
	
	


	if(count($_GET) == 8)
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
								'ARIANE' => $ariane_paiement_manuel,
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
	
	
		$id_client = intval($_GET['id_client']);
		$id_res = intval($_GET['id_res']);
		$id_trajet1 = intval($_GET['id_trajet1']);
		$id_trajet2 = intval($_GET['id_trajet2']);
		$id_ligne1 = intval($_GET['id_ligne1']);
		$id_ligne2 = intval($_GET['id_ligne2']);
		$ar = intval($_GET['ar']);
		$alea = $_GET['alea'];
		
		
		$class_erreur = "";
		$erreur = "";
		
		$supplement = "";
		
		$tab_surcout = array(1, 2);
		
		$sql_get_info_client = query("SELECT id_pays, civilite, nom, prenom, adresse, code_postal, ville, mail, tel_fixe, tel_port, nb_alea, ind_fixe, ind_port
									 FROM aeroport_client
									 WHERE id_client = '" . $id_client . "'");
		
		if($sql_get_info_client->rowCount() != 1)
		{
			$class_erreur = "erreur";
			$erreur = $client_existe_pas;
		}
		else
		{
			$row_client = $sql_get_info_client->fetch();
			
			if($alea != $row_client['nb_alea'])
			{
				$class_erreur = "erreur";
				$erreur = $code_incorect;
			}
			else
			{
				$tpl->set(array(
							"TXT_CIVILITE_CLIENT" => $row_client['civilite'],
							"TXT_NOM_CLIENT" => $row_client['nom'],
							"TXT_PRENOM_CLIENT" => $row_client['prenom'],
							"TXT_MAIL_CLIENT" => $row_client['mail'],
							"TXT_TEL_CLIENT" => $row_client['tel_fixe'],
							"TXT_PORT_CLIENT" => $row_client['tel_port'],
							"TXT_ADRESSE_CLIENT" => $row_client['adresse'],
							"TXT_CODE_POST_CLIENT" => $row_client['code_postal'],
							"TXT_VILLE_CLIENT" => $row_client['ville'],
							"TXT_PAYS_CLIENT" => get_pays(intval($row_client['id_pays'])),
							"TXT_IND_FIXE" => get_indicatif($row_client['ind_fixe']),
							"TXT_IND_PORT" => get_indicatif($row_client['ind_port'])
							)
					 );	

                $mail_client_ca = $row_client['mail'];
				
				$sql_res = query("SELECT id_client, DATE_FORMAT(date, '%d-%m-%Y') AS date_jour, DATE_FORMAT(date, '%H') AS date_heure, DATE_FORMAT(date, '%i') AS date_min, DATE_FORMAT(date, '%s') AS date_sec, commentaire, estSimple, supplement, res_der_min
								 FROM aeroport_reservation
								 WHERE id_res = '" . $id_res . "'");
				
				if($sql_res->rowCount() != 1)
				{
					$class_erreur = "erreur";
					$erreur = $res_pas_trouve;
					
					$sql_res->closeCursor();
				}
				else
				{
					$row_res = $sql_res->fetch();
					
					if($row_res['id_client'] != $id_client)
					{
						$class_erreur = "erreur";
						$erreur = $res_pas_au_client;
						
						$sql_res->closeCursor();
					}
					else
					{
						$tpl->set(array(
										"TXT_INFO_COMPL" => nl2br(wordwrap($row_res['commentaire'], 100, '<br />', true)),
										"DATE_RES_JOUR" => $row_res['date_jour'],
										"DATE_RES_HEURE" => $row_res['date_heure'],
										"DATE_RES_MIN" => $row_res['date_min'],
										"DATE_RES_SES" => $row_res['date_sec'],
										"SUPPLEMENT" => $row_res['supplement'],
										"TXT_TYPE_TRAJET" => ($row_res['estSimple'] == 1) ? $trajet_aller_simple : $trajet_aller_retour
										)
								  );
						
						$sql_res->closeCursor();
						
						$sql_trajet1 = query("SELECT id_lieu_depart, id_lieu_dest, DATE_FORMAT(date, '%d-%m-%Y') AS date_jour, DATE_FORMAT(date, '%Hh%i') AS date_heure, estFixe, est_paye
											FROM aeroport_trajet
											WHERE id_trajet = '" . $id_trajet1 . "'");

						
						if($sql_trajet1->rowCount() != 1)
						{
							$class_erreur = "erreur";
							$erreur = $trajet_introuvable;
							
							$sql_trajet1->closeCursor();
						}
						else
						{
							$sql_ligne_resa1 = query("SELECT id_res, id_trajet, id_pt_rass, rassemblement, info_vol, nb_pers, nb_enfant, heure, prix, estFixe, supplement, prix_base, rajout, est_paye, type_trajet
													 FROM aeroport_ligne_resa
													 WHERE id_ligne = '" . $id_ligne1 . "'");
							
							if($sql_ligne_resa1->rowCount() != 1)
							{
								$class_erreur = "erreur";
								$erreur = $ligne_introuvable_aller;
								
								$sql_ligne_resa1->closeCursor();
								$sql_trajet1->closeCursor();
							}
							else
							{
								$row_trajet1 = $sql_trajet1->fetch();
								$row_ligne1 = $sql_ligne_resa1->fetch();

								if($row_ligne1['id_trajet'] != $id_trajet1)
								{
									$class_erreur = "erreur";
									$erreur = $ligne_corr_trajet;
									
									$sql_ligne_resa1->closeCursor();
									$sql_trajet1->closeCursor();
								}
								else
								{
									if($row_ligne1['est_paye'] == '1')
									{
										$class_erreur = "erreur_payer";
										$erreur = $ligne_aller_payer;
									}
								
									$id_lieu_dest = $row_trajet1['id_lieu_dest'];

									$ret_prix_trajet = query("SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $id_lieu_dest . "'");
			
									$sql = "";
									if($id_lieu_dest == 100)
									{
										$sql = "SELECT prix_forfait, nb_personne FROM aeroport_lieu WHERE id_lieu = '" . $row_trajet1['id_lieu_depart'] . "'";

										$ret_prix_trajet = query($sql);
									}
									
									$row = $ret_prix_trajet->fetch();
									
									$prix_forfait_aller = $row['prix_forfait'];
									$nb_personne_forfait_aller = $row['nb_personne'];
									$prix_forfait_retour = $row['prix_forfait'];
									$nb_personne_forfait_retour = $row['nb_personne'];
									
									$ret_prix_trajet->closeCursor();
									
									$cout_par_personne_aller = ($prix_forfait_aller / $nb_personne_forfait_aller);
									$cout_par_personne_retour = ($prix_forfait_retour / $nb_personne_forfait_retour);
									
									
									if($row_ligne1['rajout'] == "1")
									{
										$nb_personne_forfait_aller = 1;
				
										$cout_par_personne_aller = ($prix_forfait_aller / $row['nb_personne']);
									}
									
									$lieu_depart = get_lieu($row_trajet1['id_lieu_depart']);
									$lieu_arrive = get_lieu($row_trajet1['id_lieu_dest']);
			
			
									$tpl->set(array(
													"TXT_TRAJET_DEPART" => $lieu_depart,
													"TXT_TRAJET_ARRIVE" => $lieu_arrive,
													"TXT_PT_RASS_ALLER" => get_pt_rass($row_ligne1['id_pt_rass']),
													"TXT_RASS_DOM_ALLER" => $row_ligne1['rassemblement'],
													"TXT_DATE_DEPART" => $row_trajet1['date_jour'],
													"TXT_HEURE_DEPART" => $row_trajet1['date_heure'],
													"TXT_PASSAGER_ADULTE_ALLER" => $row_ligne1['nb_pers'],
													"TXT_PASSAGER_ENFANT_ALLER" => $row_ligne1['nb_enfant'],
													"INFO_VOL_ALLER" => str_replace('<br />', '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', nl2br($row_ligne1['info_vol'])),
													"TXT_NB_PASSAGER_TOT" => (intval($row_ligne1['nb_pers']) + intval($row_ligne1['nb_enfant'])),
													"TXT_FORFAIT_MINI_ALLER" => $nb_personne_forfait_aller,
													"TXT_COUT_TRAJET_ALLER" => $row_ligne1['prix_base'],
													"COUT_PAR_PERSONNE_ALLER" => $cout_par_personne_aller,
													"TXT_SURCOUT_ALLER" => ($row_ligne1['estFixe'] == "0" && (in_array($row_trajet1['id_lieu_dest'], $tab_surcout) || in_array($row_trajet1['id_lieu_depart'], $tab_surcout))) ? 15 : 0,
													"PRIX_PRISE_ALLER" => $row_ligne1['supplement'],
													"DOMICILE_ALLER" => ($row_ligne1['supplement'] != 0) ? true : false
													)
											 );
									
									$sql_ligne_resa1->closeCursor();
									$sql_trajet1->closeCursor();
									
									
									if($row_res['estSimple'] == "0" && $ar == "1")
									{
										$sql_trajet2 = query("SELECT id_lieu_depart, id_lieu_dest, DATE_FORMAT(date, '%d-%m-%Y') AS date_jour, DATE_FORMAT(date, '%Hh%i') AS date_heure, estFixe, est_paye
															FROM aeroport_trajet
															WHERE id_trajet = '" . $id_trajet2 . "'");

							
										if($sql_trajet2->rowCount() != 1)
										{
											$class_erreur = "erreur";
											$erreur = $trajet_introuvable;
											
											$sql_trajet2->closeCursor();
										}
										else
										{
											$sql_ligne_resa2 = query("SELECT id_res, id_trajet, id_pt_rass, rassemblement, info_vol, nb_pers, nb_enfant, heure, prix, estFixe, supplement, prix_base, rajout, est_paye
																	 FROM aeroport_ligne_resa
																	 WHERE id_ligne = '" . $id_ligne2 . "'");

											
											if($sql_ligne_resa2->rowCount() != 1)
											{
												$class_erreur = "erreur";
												$erreur = $ligne_introuvable_aller;
												
												$sql_ligne_resa2->closeCursor();
												$sql_trajet2->closeCursor();
											}
											else
											{
												$row_trajet2 = $sql_trajet2->fetch();
												$row_ligne2 = $sql_ligne_resa2->fetch();
												
												if($row_ligne2['est_paye'] == '1')
												{
													$class_erreur = "erreur";
													$erreur = $ligne_retour_payer;
												}
												
												if($row_ligne2['id_trajet'] != $id_trajet2)
												{
													$class_erreur = "erreur_payer";
													$erreur = $ligne_corr_trajet;
												}

												if($row_ligne2['rajout'] == "1")
												{
													$nb_personne_forfait_retour = 1;
				
													$cout_par_personne_retour = ($prix_forfait_retour / $row['nb_personne']);
												}
												
												$tpl->set(array(
																"TXT_PT_RASS_RETOUR" => get_pt_rass($row_ligne2['id_pt_rass']),
																"TXT_RASS_DOM_RETOUR" => $row_ligne2['rassemblement'],
																"TXT_DATE_RETOUR" => $row_trajet2['date_jour'],
																"TXT_HEURE_RETOUR" => $row_trajet2['date_heure'],
																"TXT_PASSAGER_ADULTE_RETOUR" => $row_ligne2['nb_pers'],
																"TXT_PASSAGER_ENFANT_RETOUR" => $row_ligne2['nb_enfant'],
																"INFO_VOL_RETOUR" => str_replace('<br />', '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', nl2br($row_ligne2['info_vol'])),
																"TXT_NB_PASSAGER_TOT" => (intval($row_ligne2['nb_pers']) + intval($row_ligne2['nb_enfant'])),
																"TXT_FORFAIT_MINI_RETOUR" => $nb_personne_forfait_retour,
																"TXT_COUT_TRAJET_RETOUR" => $row_ligne2['prix_base'],
																"COUT_PAR_PERSONNE_RETOUR" => $cout_par_personne_retour,
																"TXT_SURCOUT_RETOUR" => ($row_ligne2['estFixe'] == "0" && (in_array($row_trajet2['id_lieu_dest'], $tab_surcout) || in_array($row_trajet2['id_lieu_depart'], $tab_surcout))) ? 15 : 0,
																"PRIX_PRISE_RETOUR" => $row_ligne2['supplement'],
																"DOMICILE_RETOUR" => ($row_ligne2['supplement'] != 0) ? true : false
																)
														 );
												
												$sql_ligne_resa2->closeCursor();
												$sql_trajet2->closeCursor();
											}
										}
									}
								}
							}
						}
					}
				}
			}		
		}
		
		
		
		$sql_get_info_client->closeCursor();
		
		
		
		if($class_erreur == "erreur")
		{
			$tpl->set(array(
							"CLASS_ERREUR" => $class_erreur,
							"ERREUR" => $erreur,
							"TITRE_PAGE" => $ariane_paiement_manuel_titre,
							"RECAPITULATIF" => $recapitulatif
							)
					 );
		}
		else
		{
			$txt_der_min_72 = get_option("maj_72");
			$txt_der_min_24 = get_option("maj_24");
			
			
			$prix_total_a_payer = 0;
			
			
			$nb_pers_aller = (intval($row_ligne1['nb_pers']) + intval($row_ligne1['nb_enfant']));
			$nb_pers_retour = 0;
			$nb_pers_tot = (intval($row_ligne1['nb_pers']) + intval($row_ligne1['nb_enfant']));
			
			if($row_res['estSimple'] == "0" && $ar == "1")
				$nb_pers_tot += (intval($row_ligne2['nb_pers']) + intval($row_ligne2['nb_enfant']));
			
			$res_der_min_24 = false;
			$res_der_min_72 = false;
			
			
			if($row_ligne1['type_trajet'] == 'ALLER')
			{
				if($row_res['res_der_min'] == "24")
				{
					$prix_total_a_payer += $txt_der_min_24;
					$res_der_min_24 = true;
				}
				elseif($row_res['res_der_min'] == "72")
				{
					$prix_total_a_payer += $txt_der_min_72;
					$res_der_min_72 = true;
				}
			}
			
			
			$prix_total_a_payer += $row_ligne1['prix_base'] + $row_ligne1['supplement'];
			
		
			if($row_ligne1['estFixe'] == "0" && (in_array($row_trajet1['id_lieu_dest'], $tab_surcout) || in_array($row_trajet1['id_lieu_depart'], $tab_surcout)))
				$prix_total_a_payer += get_option("maj_surcout_demande");
				
				
			if($row_res['estSimple'] == "0" && $ar == "1")
			{
				$nb_pers_retour = (intval($row_ligne2['nb_pers']) + intval($row_ligne1['nb_enfant']));
				
				$prix_total_a_payer += $row_ligne2['prix_base'] + $row_ligne2['supplement'];
				
				if($row_ligne2['estFixe'] == "0" && (in_array($row_trajet2['id_lieu_dest'], $tab_surcout) || in_array($row_trajet2['id_lieu_depart'], $tab_surcout)))
					$prix_total_a_payer += get_option("maj_surcout_demande");
			}
			
			
			
			$lang_paypal = (strtolower($_SESSION['lang']) == 'fr') ? 'FR' : 'GB';
			$custom = "0|0|0|" . $_SESSION['lang'] . "|0|1|" . $id_ligne1;
			
	
			$descr_trajet = 'Trajet '. $lieu_depart. ' -> '. $lieu_arrive . ' | Date : ' . $row_trajet1['date_jour'];
			
			if($row_res['estSimple'] == 0 && $ar == "1")
			{
				$descr_trajet .= " et " . $row_trajet2['date_jour'];
				$custom .= "|1|" . $id_ligne2 . "|0";
			}
			else
				$custom .= '|0|0|0';


            if($active_ca)
                $encrypted_ca = crypter($custom . "-|-" . $prix_total_a_payer . "-|-" . $mail_client_ca);
            else
                $encrypted_ca = "";


            global $active_paypal, $active_ca;


            if($active_paypal)
                $encrypted = form_paypal($prix_total_a_payer, $descr_trajet, $custom, $lang_paypal);
            else
                $encrypted = "0";
			
            
            
			$tpl->set(array(
							"CLASS_ERREUR" => $class_erreur,
							"ERREUR" => $erreur,
							"EMAIL" => $email,
							"TITRE_MON_TRAJET" => $mon_trajet,
							"TITRE_PAGE" => $ariane_paiement_manuel_titre,
							"RECAPITULATIF" => $recapitulatif,
							"TITRE_TRAJET" => $titre_trajet,
							"TITRE_CLIENT" => $titre_client,
							"TYPE_TRAJET" => $trajet_type,
							"TRAJET_DEPART" => $trajet_depart,
							"TRAJET_ARRIVE" => $trajet_arrive,
							"DATE_DEPART" => $date,
							"DATE_RETOUR" => $date,
							"HEURE_DEPART" => $heure,
							"HEURE_RETOUR" => $heure,
							"INFO_VOL" => $info_vol,
							"PT_RASSEMBLEMENT" => $pt_rassemblement,
							"PASSAGER_ADULTE" => $passager_adulte,
							"PASSAGER_ENFANT" => htmlentities($passager_enfant),
							"INFO_COMPL" => $info_compl,
							"ALLER" => $aller,
							"RETOUR" => $retour,
							"PROVENANCE_VOL" => $provenance_vol,
							"COMPAGNIE_VOL" => $compagnie_vol,
							"HEURE_VOL" => $heure_vol,
							"DEST_VOL" => $dest_vol,
							"NOM_CLIENT" => $nom_client,
							"PRENOM_CLIENT" => $prenom_client,
							"TEL_CLIENT" => $tel_client,
							"PORT_CLIENT" => $port_client,
							"ADRESSE_CLIENT" => $adresse_client,
							"CODE_POST_CLIENT" => $code_post_client,
							"VILLE_CLIENT" => $ville_client,
							"PAYS_CLIENT" => $pays_client,
							"CIVILITE" => $civilite,
							"COMPAGNIE" => $compagnie_vol,
							"DEST_VOL" => $dest_vol,
							"HEURE_VOL" => $heure_vol,
							"TARIFS" => $tarif,
							"TRAJET" => ($row_res['estSimple'] == "0" && $ar == "1") ? "0" : "1",
							"ALLER" => $aller,
							"RETOUR" => $retour,
							"COUT_TRAJET_BASE" => $cout_trajet_base,
							"TARIFS_XX_PERSONNE" => $tarif_s . " " . $nb_pers_tot . " " . $personne . "s",
							"TARIFS_XX_PERSONNE_ALLER" => $tarif_s . " " . $nb_pers_aller . " " . $personne . "s",
							"TARIFS_XX_PERSONNE_RETOUR" => $tarif_s . " " . $nb_pers_retour . " " . $personne . "s",
							"SURCOUT_DEMANDE" => $surcout_demande,
							"PRISE_DOMICILE" => $prise_domicile,
							"DEPOSE_DOMICILE" => $depose_domicile,
							"RES_DER_MIN_72" => $res_der_minute_72,
							"RES_DER_MIN_24" => $res_der_minute_24,
							"PRIX_TOTAL" => $prix_total,
							"PERSONNE" => $personne,
							"FORFAIT_MINI" => $forfait_mini,
							"TXT_DER_MIN_72" => $txt_der_min_72,
							"TXT_DER_MIN_24" => $txt_der_min_24,
							"DERNIERE_MINUTE_72" => $res_der_min_72,
							"DERNIERE_MINUTE_24" => $res_der_min_24,
							"TXT_PRIX_TOTAL" => $prix_total_a_payer,
							"TXT_NB_PASSAGER_ALLER" => $nb_pers_aller,
							"TXT_NB_PASSAGER_RETOUR" => $nb_pers_retour,
							"ENCRYPTED" => $encrypted,
							"TARGET_IMG_PAYPAL" => (strtolower($_SESSION['lang']) == 'fr') ? 'fr_FR/FR' : 'en_US',
							"ALT_PAYPAL" => $alt_paypal,
                            "ACTIVE_PAYPAL" => $active_paypal,
                            "ACTIVE_CA" => $active_ca,
                            "MODE_DE_PAIEMENT" => $mode_de_paiement,
                            "INFO_MODE_PAIEMENT" => $info_mode_paiement,
                            "ENCRYPTED_CA" => $encrypted_ca
							)
					  );
			
		}
			
		$tpl->parse("aeroport/reservation/paiement-manuel.html");
	}
	else
	{
		header('Location: ../index.html');
		exit();
	}

?>

